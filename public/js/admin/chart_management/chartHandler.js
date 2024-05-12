$(document).ready(function () {

    getRevenueChart();
    getNewAccounts();
    getOrdersInYear();
    getOrderReturnedRatio();

    function getRevenueChart() {
        $.ajax({
            url: '/getRevenueInYear',
            type: 'GET',
            success: function (response) {
                let myChart1 = document.getElementById('chart1').getContext('2d');
                let barChart1 = new Chart(chart1, {
                    type: 'bar',
                    data: {
                        labels: response.map(item => item.month),
                        datasets: [{
                            label: 'Doanh số tháng (VNĐ)',
                            data: response.map(item => item.revenue),
                            borderWidth: 1,
                            backgroundColor: 'aqua'
                        }]
                    },
                    options: {
                        plugins: {
                            title: {
                                display: true,
                                text: 'Doanh số hàng tháng trong năm 2024',
                                font: {
                                    size: 20
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Doanh số'
                                },
                                ticks: { precision: 0 },
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Tháng'
                                }
                            }
                        }
                    }
                })

            }
        })
    }

    function getNewAccounts() {
        $.ajax({
            url: '/getNewAccountsInYear',
            type: 'GET',
            success: function (response) {
                let myChart2 = document.getElementById('chart2').getContext('2d');
                let barChart2 = new Chart(chart2, {
                    type: 'bar',
                    data: {
                        labels: response.map(item => item.month),
                        datasets: [{
                            label: 'Số tài khoản mới phát sinh',
                            data: response.map(item => item.new_account),
                            borderWidth: 1,
                            backgroundColor: 'aqua'
                        }]
                    },
                    options: {
                        plugins: {
                            title: {
                                display: true,
                                text: 'Số tài khoản mới hàng tháng trong năm 2024',
                                font: {
                                    size: 20
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Số tài khoản mới phát sinh'
                                },
                                ticks: { precision: 0 },
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Tháng'
                                }
                            }
                        }
                    }
                })

            }
        })
    }

    function getOrdersInYear() {
        $.ajax({
            url: '/getOrdersInYear',
            type: 'GET',
            success: function (response) {
                let myChart3 = document.getElementById('chart3').getContext('2d');
                let barChart3 = new Chart(chart3, {
                    type: 'bar',
                    data: {
                        labels: response.map(item => item.month),
                        datasets: [{
                            label: 'Số đơn hàng mới phát sinh hàng tháng',
                            data: response.map(item => item.count),
                            borderWidth: 1,
                            backgroundColor: 'aqua'
                        }]
                    },
                    options: {
                        plugins: {
                            title: {
                                display: true,
                                text: 'Số đơn hàng mới phát sinh hàng tháng trong năm 2024',
                                font: {
                                    size: 20
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Số đơn hàng mới phát sinh'
                                },
                                ticks: { precision: 0 },
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Tháng'
                                }
                            }
                        }
                    }
                })

            }
        })
    }

    function getOrderReturnedRatio() {
        $.ajax({
            url: '/getOrderReturnedRatioInYear',
            type: 'GET',
            success: function (response) {
                let myChart4 = document.getElementById('chart4').getContext('2d');
                let barChart4 = new Chart(chart4, {
                    type: 'bar',
                    data: {
                        labels: response.map(item => item.month),
                        datasets: [{
                            label: 'Tỷ lệ trả hàng hàng tháng (%)',
                            data: response.map(item => item.count),
                            borderWidth: 1,
                            backgroundColor: 'aqua'
                        }]
                    },
                    options: {
                        plugins: {
                            title: {
                                display: true,
                                text: 'Tỷ lệ trả hàng hàng tháng trong năm 2024',
                                font: {
                                    size: 20
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Tỷ lệ trả hàng'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Tháng'
                                }
                            }
                        }
                    }
                })

            }
        })
    }
})