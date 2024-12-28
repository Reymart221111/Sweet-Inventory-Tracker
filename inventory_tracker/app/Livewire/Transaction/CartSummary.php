<?php

namespace App\Livewire\Transaction;

use Livewire\Component;
use App\Models\ItemProducts;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Illuminate\Support\Collection;

class CartSummary extends Component
{
    // Public properties for binding to view
    public array $cartItems = [];
    public float $totalAmount = 0;
    public string $customerName = '';
    public string $customerContact = '';
    public bool $showConfirmationModal = false;

    // Listeners for events
    protected $listeners = [
        'add-to-cart' => 'addToCart'
    ];

    /**
     * Handle store event and flash appropriate message
     */
    #[On('error-event')]
    public function handleStoreEvent(array $event): void
    {
        $flashMethod = $event['status'] === 'success' ? 'success' : 'error';
        session()->flash($flashMethod, $event['message']);
    }

    /**
     * Adds a product to the cart
     */
    public function addToCart(array $data): void
    {
        $productId = $data['productId'];
        $quantity = $data['quantity'];

        // Find the product
        $product = $this->findProductOrFail($productId);

        // Validate stock availability
        if (!$this->isStockAvailable($product, $quantity)) {
            return;
        }

        // Update or add cart item
        $this->updateOrAddCartItem($product, $quantity);

        // Recalculate and notify
        $this->calculateTotal();
        $this->dispatch('stockUpdated');
        $this->flashSuccessMessage($product, $quantity);
    }

    /**
     * Find product or fail
     */
    private function findProductOrFail(int $productId): ItemProducts
    {
        return ItemProducts::findOrFail($productId);
    }

    /**
     * Check if stock is available
     */
    private function isStockAvailable(ItemProducts $product, int $quantity): bool
    {
        if ($quantity > $product->stocks) {
            session()->flash('error', 'Insufficient stock for this product.');
            return false;
        }
        return true;
    }

    /**
     * Update existing cart item or add new
     */
    private function updateOrAddCartItem(ItemProducts $product, int $quantity): void
    {
        $cartCollection = collect($this->cartItems);
        $existingItemIndex = $this->findExistingCartItemIndex($cartCollection, $product->id);

        if ($existingItemIndex !== false) {
            $this->updateExistingCartItem($existingItemIndex, $product, $quantity);
        } else {
            $this->addNewCartItem($product, $quantity);
        }
    }

    /**
     * Find index of existing cart item
     */
    private function findExistingCartItemIndex(Collection $cartCollection, int $productId): int|bool
    {
        return $cartCollection->search(fn($item) => $item['product_id'] === $productId);
    }

    /**
     * Update quantity of existing cart item
     */
    private function updateExistingCartItem(int $index, ItemProducts $product, int $quantity): void
    {
        $this->cartItems[$index]['quantity'] += $quantity;
        $this->cartItems[$index]['subtotal'] = $this->cartItems[$index]['quantity'] * $product->price;
    }

    /**
     * Add new item to cart
     */
    private function addNewCartItem(ItemProducts $product, int $quantity): void
    {
        $this->cartItems[] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $quantity,
            'subtotal' => $quantity * $product->price,
            'image' => $product->image_path
        ];
    }

    /**
     * Flash success message
     */
    private function flashSuccessMessage(ItemProducts $product, int $quantity): void
    {
        session()->flash('success', "{$quantity} x {$product->name} added to cart.");
    }

    /**
     * Remove product from cart
     */
    public function removeFromCart(int $productId): void
    {
        $cartCollection = collect($this->cartItems);
        $itemIndex = $this->findExistingCartItemIndex($cartCollection, $productId);

        if ($itemIndex !== false) {
            unset($this->cartItems[$itemIndex]);
            $this->cartItems = array_values($this->cartItems);

            $this->calculateTotal();
            $this->dispatch('stockUpdated');
            session()->flash('success', "Product removed from cart.");
        }
    }

    /**
     * Calculate total cart amount
     */
    private function calculateTotal(): void
    {
        $this->totalAmount = collect($this->cartItems)->sum('subtotal');
    }

    /**
     * Initiate order submission
     */
    public function submitOrder(): void
    {
        if (empty($this->cartItems)) {
            session()->flash('error', 'Your cart is empty.');
            return;
        }

        $this->validate([
            'customerName' => 'nullable|string|max:255',
            'customerContact' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^(\+?[\d\s\-().]{10,20})$/'
            ],
            'cartItems' => 'required|array|min:1'
        ]);

        $this->showConfirmationModal = true;
    }

    /**
     * Confirm and process order
     */
    public function confirmOrder(): void
    {
        try {
            DB::beginTransaction();

            $this->validateStockBeforeOrder();
            $order = $this->createOrder();
            $this->createOrderItems($order);

            DB::commit();
            $this->resetOrderState();
            $this->dispatch('stockUpdated');
            session()->flash('success', 'Order submitted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to submit order: ' . $e->getMessage());
            $this->showConfirmationModal = false;
        }
    }

    protected function rules()
    {
        return [
            'customerName' => 'nullable|string|max:255',
            'customerContact' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^(\+?[\d\s\-().]{10,20})$/'
            ],
        ];
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Validate stock for each cart item before order
     */
    private function validateStockBeforeOrder(): void
    {
        foreach ($this->cartItems as $item) {
            $product = ItemProducts::findOrFail($item['product_id']);
            if ($item['quantity'] > $product->stocks) {
                throw new \Exception("Insufficient stock for {$product->name}.");
            }
        }
    }

    /**
     * Create order record
     */
    private function createOrder(): Order
    {
        return Order::create([
            'total_amount' => $this->totalAmount,
            'customer_name' => $this->customerName,
            'customer_contact_number' => $this->customerContact
        ]);
    }

    /**
     * Create order items and update stock
     */
    private function createOrderItems(Order $order): void
    {
        foreach ($this->cartItems as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);

            $product = ItemProducts::findOrFail($item['product_id']);
            $product->decrement('stocks', $item['quantity']);
        }
    }

    /**
     * Reset order state
     */
    private function resetOrderState(): void
    {
        $this->reset([
            'cartItems',
            'totalAmount',
            'customerName',
            'customerContact',
            'showConfirmationModal'
        ]);
    }

    /**
     * Cancel order
     */
    public function cancelOrder(): void
    {
        $this->resetOrderState();
        $this->dispatch('stockUpdated');
        $this->showConfirmationModal = false;
        session()->flash('success', 'Order cancelled.');
    }

    /**
     * Clear session messages
     */
    public function clearSession(): void
    {
        session()->forget(['success', 'error']);
    }

    /**
     * Render component
     */
    public function render()
    {
        return view('livewire.transaction.cart-summary', [
            'cartItems' => $this->cartItems,
            'totalAmount' => $this->totalAmount
        ]);
    }
}
