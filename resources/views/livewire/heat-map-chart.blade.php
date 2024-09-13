<div class="h-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">

    <div class="flex justify-between mb-3">
        <div class="flex justify-center items-center">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Bookings heatmap</h5>
        </div>

    </div>

    <!-- HeapMap Chart -->
    <div class="" id="heatmap"></div>

</div>


{{-- @dd($init_heatmap_data) --}}
@script
    <script>
        const generateData = (count, yrange) => {
            let i = 0;
            const series = [];
            while (i < count) {
                const x = `W${i + 1}`;
                const y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
                series.push({
                    x,
                    y
                });
                i++;
            }
            return series;
        };
        // ---------------------------------------------------
        let heatmapInitData = @json($init_heatmap_data);
        // console.log(heatmapInitData);

        // -------------------------
        // console.log(generateData(52, {
        //     min: 0,
        //     max: 0
        // }));

        let getHeatmapOptions = (heatmapInitData) => {
            return {
                series: [{
                        name: 'Su',
                        data: heatmapInitData.Sunday,
                    }, {
                        name: 'Sa',
                        data: heatmapInitData.Saturday,
                    },
                    {
                        name: 'Fr',
                        data: heatmapInitData.Friday,
                    },
                    {
                        name: 'Th',
                        data: heatmapInitData.Thursday,
                    },
                    {
                        name: 'We',
                        data: heatmapInitData.Wednesday,
                    },
                    {
                        name: 'Tu',
                        data: heatmapInitData.Tuesday,
                    },
                    {
                        name: 'Mo',
                        data: heatmapInitData.Monday,
                    }
                ],
                chart: {
                    height: 260,
                    type: 'heatmap',
                    toolbar: {
                        show: false // Disable the toolbar
                    }
                },
                plotOptions: {
                    heatmap: {
                        // shadeIntensity: 0.5,
                        colorScale: {
                            ranges: [{
                                    from: 0,
                                    to: 0,
                                    color: '#F9F9F9'
                                },
                                {
                                    from: 1,
                                    to: 5,
                                    color: '#8AAEB4'
                                },
                                {
                                    from: 6,
                                    to: 10,
                                    color: '#33727D'
                                },
                                {
                                    from: 11,
                                    to: 15,
                                    color: '#004F5C'
                                },
                            ],
                        },
                        legend: {
                            labels: {
                                colors: ['#F9F9F9', '#8AAEB4', '#33727D', '#004F5C'], // Custom colors for legend
                            }
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#666565',
                        }
                    },
                    // opposite: true // Ensure that the labels are not displayed on the opposite side
                },
                xaxis: {
                    type: 'category',
                    // categories: [...Array(52).keys()].map(i => `W${i + 1}`),
                    labels: {
                        show: false // Hide the x-axis labels
                    },
                    axisBorder: {
                        show: false // Hide the x-axis border
                    },
                    axisTicks: {
                        show: false // Hide the x-axis ticks
                    }
                },
                // title: {
                //     text: 'Booking Heatmap',
                // },
                legend: {
                    position: 'bottom',
                    horizontalAlign: 'left',
                    fontFamily: 'Inter, sans-serif',
                    markers: {
                        width: 10,
                        height: 10,
                        radius: 0,
                        offsetX: -2
                    }
                },
                // colors: ['#FF4560', '#008FFB', '#00E396', '#FEB019', '#775DD0', '#546E7A', '#26A69A'],
            }
        };

        const chart = new ApexCharts(document.querySelector("#heatmap"), getHeatmapOptions(heatmapInitData));
        chart.render();
    </script>
@endscript
