// var ctx = document.getElementById('myChart').getContext('2d');
// var myChart = new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
//         datasets: [{
//             label: '# of Votes',
//             data: [12, 19, 3, 5, 2, 3],
//             backgroundColor: [
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(255, 206, 86, 0.2)',
//                 'rgba(75, 192, 192, 0.2)',
//                 'rgba(153, 102, 255, 0.2)',
//                 'rgba(255, 159, 64, 0.2)'
//             ],
//             borderColor: [
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(255, 206, 86, 1)',
//                 'rgba(75, 192, 192, 1)',
//                 'rgba(153, 102, 255, 1)',
//                 'rgba(255, 159, 64, 1)'
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero: true
//                 }
//             }]
//         }
//     }
// });

function updateBars(deviceId) {
    $.ajax({
        url: 'graphs.php',
        type: 'post',
        data: {
            deviceId: deviceId
        },
        success: function(response) {
            console.log(response);
            var json = JSON.parse(response);
            console.log(json); 

            var stores = [];
            var prices = [];
            var prices_month = [];
            var prices_3month = [];
            for(var i = 0; i < json.length; i++) {
                stores.push(json[i].store);
                prices.push(json[i].price);
                prices_month.push(json[i].price_month);
                prices_3month.push(json[i].price_3month);
            }

            if(stores.length > 0) {
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: stores,
                        datasets: [
                            {
                                label: 'Цена 3 месяца назад',
                                data: prices_3month,
                                backgroundColor: 'rgba(255, 0, 0, 0.25)',
                                borderColor: 'rgba(255, 0, 0, 1)',
                                borderWidth: 2
                            },
                            {
                                label: 'Цена месяц назад',
                                data: prices_month,
                                backgroundColor: 'rgba(0, 255, 0, 0.25)',
                                borderColor: 'rgba(0, 255, 0, 1)',
                                borderWidth: 2
                            },
                            {
                                label: 'Цена сейчас',
                                data: prices,
                                backgroundColor: 'rgba(0, 0, 255, 0.25)',
                                borderColor: 'rgba(0, 0, 255, 1)',
                                borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            } else {
                
            }

            
        }  
    });
}