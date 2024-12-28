<?php

namespace App\Livewire\Dashboard;

use App\Charts\SalesChart;
use App\Models\ItemProducts;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowDashboard extends Component
{
    public $activeProducts;
    public $lowStockProducts;
    public $recentProducts;
    public $soldItems;
    public $totalRevenue;
    public $numberOfOrders;
    public $zeroStockProducts;
    public $totalEarnings;

    public $dailyProductSales;
    public $monthlyProductSales;
    public $dailyEarnings;
    public $monthlyEarnings;

    public $listeners = ['chartDataUpdated'];

    public function chartDataUpdated()
    {
        $this->dispatchBrowserEvent('refreshCharts');
    }


    public function mount()
    {
        // Existing Metrics
        $this->activeProducts = ItemProducts::where('stocks', '>', 0)->count();
        $this->lowStockProducts = ItemProducts::where('stocks', '<', 10)->where('stocks', '>', 0)->count();
        $this->recentProducts = ItemProducts::latest()->take(10)->count();

        $order_product = OrderProduct::with('product')
            ->selectRaw("SUM(quantity) as total_quantity")
            ->get();

        $this->soldItems = $order_product->first()->total_quantity ?? 0;

        $this->totalRevenue = Order::sum('total_amount');
        $this->numberOfOrders = Order::count();
        $this->zeroStockProducts = ItemProducts::where('stocks', '=', 0)->count();

        $earnings = DB::table('order_product')
            ->join('item_products', 'order_product.product_id', '=', 'item_products.id')
            ->selectRaw('SUM((order_product.price - item_products.based_price) * order_product.quantity) as total_earnings')
            ->get('total_earnings');

        $this->totalEarnings = $earnings->first()->total_earnings ?? 0;

        $this->dailyProductSales = OrderProduct::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(quantity) as total_sales'))
            ->whereDate('created_at', today())
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get()
            ->pluck('total_sales', 'date')
            ->toArray();

        // Monthly Product Sales
        $this->monthlyProductSales = OrderProduct::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(quantity) as total_sales'))
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get()
            ->pluck('total_sales', 'month')
            ->toArray();

        // Daily Earnings (based on price)
        $this->dailyEarnings = OrderProduct::select(DB::raw('DATE(order_product.created_at) as date'), DB::raw('SUM((order_product.price - item_products.based_price) * order_product.quantity) as total_earnings'))
            ->join('item_products', 'order_product.product_id', '=', 'item_products.id')
            ->whereDate('order_product.created_at', today())
            ->groupBy(DB::raw('DATE(order_product.created_at)'))
            ->get()
            ->pluck('total_earnings', 'date')
            ->toArray();

        // Monthly Earnings (based on price)
        $this->monthlyEarnings = OrderProduct::select(DB::raw('MONTH(order_product.created_at) as month'), DB::raw('SUM((order_product.price - item_products.based_price) * order_product.quantity) as total_earnings'))
            ->join('item_products', 'order_product.product_id', '=', 'item_products.id')
            ->whereYear('order_product.created_at', now()->year)
            ->groupBy(DB::raw('MONTH(order_product.created_at)'))
            ->get()
            ->pluck('total_earnings', 'month')
            ->toArray();

        \Log::info($this->dailyProductSales);
        \Log::info($this->monthlyProductSales);
        \Log::info($this->dailyEarnings);
        \Log::info($this->monthlyEarnings);
    }

    public function render()
    {

        return view('livewire.dashboard.show-dashboard');
    }
}
