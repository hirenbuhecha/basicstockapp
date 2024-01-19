<script>
    $(document).ready(function () {
        $("#start_date, #end_date").datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth: true
        });
    });
</script>

@if (isset($data))
<script>
    var timestamps = @json(array_column($data, 'date'));
    var openPrices = @json(array_column($data, 'open'));
    var closePrices = @json(array_column($data, 'close'));
    var companyName = @json($companyName);

    var formattedDates = timestamps.map(timestamp => {
                var date = new Date(timestamp * 1000);
    return date.toISOString().slice(0, 19).replace('T', ' ');
    })
    ;

    // Create a chart using Chart.js
    var ctx = document.getElementById('historicalChart').getContext('2d');
    var historicalChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: formattedDates,
            datasets: [
                {
                    label: 'Open Price',
                    borderColor: 'blue',
                    data: openPrices,
                },
                {
                    label: 'Close Price',
                    borderColor: 'red',
                    data: closePrices,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: companyName + '-Stock Data Chart'
                },
            },
            scales: {
                x: {
                    type: 'time',
                    time: {
                        unit: 'day',
                    },
                    title: {
                        display: true,
                        text: 'Date',
                    },
                },
                y: {
                    title: {
                        display: true,
                        text: 'Price',
                    },
                },
            },
        },
    });
</script>
@endif
