<?php

namespace App\Livewire\Charts;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\OrderProduct;
use Carbon\Carbon;

class SampleChart extends Component
{
    public $chartData = [];

    public function mount()
    {
        $rawEarnings = OrderProduct::select(
                DB::raw('MONTH(order_product.created_at) as month'),
                DB::raw('SUM((order_product.price - item_products.based_price) * order_product.quantity) as total_earnings')
            )
            ->join('item_products', 'order_product.product_id', '=', 'item_products.id')
            ->whereYear('order_product.created_at', now()->year)
            ->groupBy(DB::raw('MONTH(order_product.created_at)'))
            ->get();

        $this->chartData = $rawEarnings->map(function ($item) {
            return [
                'month' => Carbon::createFromDate(null, $item->month, 1)->format('F'),
                'earnings' => number_format($item->total_earnings, 2),
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.charts.sample-chart', [
            'chartData' => $this->chartData,
        ]);
    }
}
