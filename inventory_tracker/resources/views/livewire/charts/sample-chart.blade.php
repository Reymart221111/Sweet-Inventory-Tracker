<div x-data="chartComponent(@entangle('chartData'))" x-init="initChart()" wire:ignore>
    <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function chartComponent(chartData) {
        return {
            chartData,
            chartInstance: null,

            initChart() {
                const ctx = document.getElementById('myChart');

                const labels = this.chartData.map(item => item.month);
                const data = this.chartData.map(item => parseFloat(item.earnings));

                this.chartInstance = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels, 
                        datasets: [{
                            label: 'Monthly Earnings',
                            data: data,
                            backgroundColor: '#4BC0C0',
                            borderColor: 'rgba(75, 192, 192, 1)',
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