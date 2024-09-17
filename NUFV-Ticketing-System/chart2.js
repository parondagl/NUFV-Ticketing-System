var ctx = document.getElementById('doughnut').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Tickets Resolved', 'Open Tickets', 'In progress Tickets'],
        datasets: [{
            label: 'Tickets',
            data: [42, 19, 3, 5],
            backgroundColor: [
                'rgba(41,155,99,1)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255,206,86,1)',
       
            ],
            borderColor: [
                'rgba(41,155,99,1)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255,206,86,1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive:true
    }
});