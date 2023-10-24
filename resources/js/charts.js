function getLast12Months() {
    const currentMonth = new Date().getMonth();
    const months = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];

    let last12Months = [];
    let monthNumbers = [];
    for (let i = 0; i < 12; i++) {
        const monthIndex = (currentMonth - i + 12) % 12;
        last12Months.unshift(months[monthIndex]);
        monthNumbers.unshift(monthIndex + 1); // +1 because months in JS are 0 indexed, and in PHP are 1 indexed
    }
    return { names: last12Months, numbers: monthNumbers };
}

const { names: months, numbers: monthNumbers } = getLast12Months();


function createChart(ctx, label, dataArray) {
    return new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: label,
                data: dataArray,
                backgroundColor: 'rgba(255, 189, 89, 0.2)',
                borderColor: 'rgba(255, 189, 89, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}


const ctxVisits = document.getElementById('myChartVisits').getContext('2d');
const dataObjectVisits = JSON.parse(document.getElementById('myChartVisits').getAttribute('data-visits'));
const dataArrayVisits = Object.values(dataObjectVisits);
createChart(ctxVisits, 'Numero di visite', dataArrayVisits);

const ctxMessages = document.getElementById('myChartMessages').getContext('2d');
const dataObjectMessages = JSON.parse(document.getElementById('myChartMessages').getAttribute('data-messages'));
const dataArrayMessages = Object.values(dataObjectMessages);
createChart(ctxMessages, 'Numero di messaggi', dataArrayMessages);