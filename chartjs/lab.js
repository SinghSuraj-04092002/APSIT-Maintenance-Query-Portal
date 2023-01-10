var lab = document.getElementById("labChart").getContext("2d");
var labChart = new Chart(lab,{
    type: 'bar',
    data:{
     labels: ['101','102','103','104','105','106','107','108','109','110'],
     datasets: [{
     label: 'Queries',
     data: [12, 19, 3, 5, 2, 3],
     hoverOffset: 4
     }]
    },
});
