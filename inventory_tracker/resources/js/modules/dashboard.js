// resources/js/modules/SalesEarningsCharts.js

import ApexCharts from 'apexcharts';

export class SalesEarningsCharts {
    constructor(chartData) {
        this.chartData = chartData;
        this.salesChart = null;
        this.earningsChart = null;
    }

    initializeCharts() {
        this.initializeSalesChart();
        this.initializeEarningsChart();

        // Render the charts
        this.salesChart.render();
        this.earningsChart.render();

        // Bind Livewire dispatched events for dynamic updates
        this.bindLivewireEvents();
    }

    initializeSalesChart() {
        this.salesChart = new ApexCharts(document.querySelector("#sales-chart"), {
            chart: {
                type: 'line',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            series: [{
                name: 'Sales',
                data: this.chartData.salesData
            }],
            xaxis: {
                categories: this.chartData.salesCategories,
                labels: {
                    rotate: -45
                }
            },
            title: {
                text: 'Sales Over Time',
                align: 'left'
            },
            colors: ['#1abc9c'],
            responsive: [{
                breakpoint: 600,
                options: {
                    chart: {
                        height: 250
                    },
                    xaxis: {
                        labels: {
                            rotate: -90
                        }
                    }
                }
            }]
        });
    }

    initializeEarningsChart() {
        this.earningsChart = new ApexCharts(document.querySelector("#earnings-chart"), {
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            series: [{
                name: 'Earnings',
                data: this.chartData.earningsData
            }],
            xaxis: {
                categories: this.chartData.earningsCategories,
                labels: {
                    rotate: -45
                }
            },
            title: {
                text: 'Total Earnings Over Time',
                align: 'left'
            },
            colors: ['#3498db'],
            responsive: [{
                breakpoint: 600,
                options: {
                    chart: {
                        height: 250
                    },
                    xaxis: {
                        labels: {
                            rotate: -90
                        }
                    }
                }
            }]
        });
    }

    showLoading(selector) {
        const loadingElement = document.querySelector(selector);
        if (loadingElement) {
            loadingElement.classList.remove('hidden');
        }
    }

    hideLoading(selector) {
        const loadingElement = document.querySelector(selector);
        if (loadingElement) {
            loadingElement.classList.add('hidden');
        }
    }

    updateSalesChart(categories, data) {
        this.showLoading('#sales-loading'); // Show loading spinner
        this.salesChart.updateOptions({
            xaxis: {
                categories: categories
            }
        });
        this.salesChart.updateSeries([{
            name: 'Sales',
            data: data
        }]).then(() => {
            this.hideLoading('#sales-loading'); // Hide loading spinner after update
        });
    }

    updateEarningsChart(categories, data) {
        this.showLoading('#earnings-loading'); // Show loading spinner
        this.earningsChart.updateOptions({
            xaxis: {
                categories: categories
            }
        });
        this.earningsChart.updateSeries([{
            name: 'Earnings',
            data: data
        }]).then(() => {
            this.hideLoading('#earnings-loading'); // Hide loading spinner after update
        });
    }

    bindLivewireEvents() {
        // Listen for dispatched events using addEventListener
        window.addEventListener('sales-data-updated', (event) => {
            const { categories, data } = event.detail;
            this.updateSalesChart(categories, data);
        });

        window.addEventListener('earnings-data-updated', (event) => {
            const { categories, data } = event.detail;
            this.updateEarningsChart(categories, data);
        });
    }
}
