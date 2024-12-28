<?php

namespace App\Livewire\ItemOrders;

use App\Models\Order;
use App\Models\OrderProduct;
use Livewire\Component;
use Livewire\WithPagination;

class ReadOrderDetails extends Component
{
    use WithPagination;
    public $search;
    public $orderId;
    public $page;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => ''],
    ];

    public function mount($orderId)
    {
        $this->orderId = $orderId;
        debugbar()->info('order id:' . $this->orderId);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $order_details = OrderProduct::with('product')
            ->selectRaw("order_product.product_id, quantity, price, price * quantity as total_price")
            ->where('order_product.order_id', $this->orderId)
            ->when($this->search, function ($query) {
                $query->whereHas('product', function ($q) {
                    $q->where('name', 'like', "%" . $this->search . "%");
                });
            })
            ->paginate(10);

        debugbar()->info('Order Details:', $order_details->toArray());

        return view('livewire.item-orders.read-order-details', ['order_details' => $order_details]);
    }
}
