<?php

namespace App\Livewire\Charts;

use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SalesChart extends Component
{
    public $chartData = [];

    public function mount()
    {
        $rawSales = OrderProduct::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(quantity) as total_sales'))
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        $this->chartData = $rawSales->map(function ($item) {
            return [
                'month' => Carbon::createFromDate(null, $item->month, 1)->format('F'),
                'earnings' => number_format($item->total_sales, 2),
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.charts.sales-chart', [
            'chartData' => $this->chartData,
        ]);
    }
}
