<div x-data="chartComponentData(@entangle('chartData'))" x-init="initChart()" wire:ignore>
    <canvas id="salesChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function chartComponentData(chartData) {
        return {
            chartData,
            chartInstance: null,

            initChart() {
                const ctx = document.getElementById('salesChart');

                const labels = this.chartData.map(item => item.month);
                const data = this.chartData.map(item => parseFloat(item.earnings));

                this.chartInstance = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels, 
                        datasets: [{
                            label: 'Monthly Sales',
                            data: data,
                            backgroundColor: '#db1f12',
                            borderColor: '#db1f12',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            },

            updateChart(newData) {
                this.chartData = newData;

                const labels = this.chartData.map(item => item.month);
                const data = this.chartData.map(item => parseFloat(item.earnings));

                this.chartInstance.data.labels = labels;
                this.chartInstance.data.datasets[0].data = data;
                this.chartInstance.update();
            }
        };
    }
</script>