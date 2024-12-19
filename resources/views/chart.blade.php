@extends('templates.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/echarts@5"></script>

<h1 class="text-center mb-4">Grafik Report dan Response</h1>
    <div class="col-md-12 d-flex align-items-center justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="col-xl-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart" id="bars_basic" style="width: 100%; height: 400px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var bars_basic_element = document.getElementById('bars_basic');
    if (bars_basic_element) {
        var bars_basic = echarts.init(bars_basic_element);
        bars_basic.setOption({
            title: {
                text: 'Grafik Report dan Response',
                left: 'center',
                textStyle: {
                    fontSize: 18,
                    fontWeight: 'bold',
                    color: '#333' // Warna judul yang lebih kontras
                }
            },
            color: ['#42a5f5', '#ff7043'], // Menambahkan dua warna untuk grafik yang lebih dinamis
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                },
                backgroundColor: 'rgba(0, 0, 0, 0.7)',
                textStyle: {
                    color: '#fff'
                },
                formatter: function (params) {
                    var result = `${params[0].name}<br>`;
                    params.forEach(function (item) {
                        result += `${item.seriesName}: ${item.value} <br>`;
                    });
                    return result;
                }
            },
            grid: {
                left: '10%',
                right: '10%',
                bottom: '10%',
                containLabel: true
            },
            xAxis: [
                {
                    type: 'category',
                    data: ['Report Count', 'Response Count'],
                    axisLabel: {
                        textStyle: {
                            fontSize: 14,
                            color: '#333'
                        }
                    },
                    axisTick: {
                        alignWithLabel: true
                    }
                }
            ],
            yAxis: [
                {
                    type: 'value',
                    axisLabel: {
                        formatter: '{value}',
                        textStyle: {
                            fontSize: 14,
                            color: '#333'
                        }
                    }
                }
            ],
            series: [
                {
                    name: 'Total Count',
                    type: 'bar',
                    barWidth: '40%', // Memperlebar batang agar lebih jelas
                    itemStyle: {
                        normal: {
                            color: '#42a5f5', // Warna batang untuk Report Count
                            borderWidth: 2,
                            borderColor: '#0d47a1', // Menambahkan border untuk batang
                            opacity: 0.8
                        }
                    },
                    emphasis: {
                        itemStyle: {
                            color: '#1565c0' // Warna saat hover
                        }
                    },
                    data: [
                        {{ $report_count }},
                        {{ $response_count }}
                    ]
                }
            ]
        });

        // Resize chart to fit container
        window.addEventListener('resize', function () {
            bars_basic.resize();
        });
    }
</script>

@endsection