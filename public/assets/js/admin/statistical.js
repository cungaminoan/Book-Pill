
$(function () {
    let chart = null;
    const statisticalChart = $('#statisticalChart')
    let statisticalChoice = $('#statistical_time')

    let date = statisticalChoice.val().split('-')

    callAPIStatistical(date)

    statisticalChoice.on('change', function (e) {
        let dateChange = e.target.value.split('-')
        callAPIStatistical(dateChange)
    })

    function callAPIStatistical(date) {
        $.ajax({
            type: 'POST',
            url: routeCalculateStatistical(),
            headers: {'X-CSRF-TOKEN': getCSRFToken()},
            data: {
                month: date[1],
                year: date[0]
            },
            success: function (response) {
                if (response.result) {
                    if (chart) {
                        chart.destroy()
                    }
                    drawChart(response.data.arrayValue)
                    $('#countWareHouse').html(response.data.countProductWarehouse)
                    $('#soldCount').html(response.data.countData)
                    $('#month').html(statisticalChoice.val())
                    $('#topSeller').html(response.data.dataTopSeller)
                } else {
                    Swal.fire(`${response.message}`, '', 'error')
                }
            }
        })
    }

    function drawChart(data) {
        chart = new Chart(statisticalChart, {
            type: 'line',
            data: {
                labels: [1, 2, 3, 4, 5, 6 ,7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27 ,28, 29, 30, 31],
                datasets: [{
                    label: 'Product Revenue',
                    data: data,
                    borderWidth: 1,
                    fill: true,
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        })
    }
})

