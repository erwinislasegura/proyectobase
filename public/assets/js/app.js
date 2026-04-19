document.addEventListener('DOMContentLoaded', () => {
  const main = document.getElementById('mainChart');
  if (main) {
    new Chart(main, {
      type: 'line',
      data: { labels: ['Ene','Feb','Mar','Abr','May','Jun'], datasets: [{ label: 'Usuarios', data: [12,18,17,25,31,40], borderColor: '#f6149a', tension: 0.35 }] },
      options: { plugins: { legend: { display: false } } }
    });
  }
  const state = document.getElementById('stateChart');
  if (state) {
    new Chart(state, {
      type: 'doughnut',
      data: { labels: ['Activos','Inactivos'], datasets: [{ data: [84,16], backgroundColor: ['#f6149a','#d6dbe5'] }] },
      options: { plugins: { legend: { position: 'bottom' } } }
    });
  }
});
