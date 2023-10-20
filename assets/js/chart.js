
const chart = (target, today, past, data) => {
    var ctx = document.getElementById(target);
    var dataset =  JSON.stringify(data);
     dataset =  JSON.parse(data);


    var myChart = new Chart(ctx, {
        type: 'line',
        options: {
            scales: {
                xAxes: [{
                    type: 'time',
                }]
            }, legend: {
                display: false
            }
        },
        data: {
            labels: [past, today],
            datasets: [{
                label: 'data',
                data: dataset,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                ],
                borderWidth: 1
            }]
        }
    });
} 
