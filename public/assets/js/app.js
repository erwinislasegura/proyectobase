document.addEventListener('DOMContentLoaded', () => {
  const searchOverlay = document.getElementById('atlSearchOverlay');
  const searchOpeners = document.querySelectorAll('[data-open-search="1"]');
  const searchClosers = document.querySelectorAll('[data-close-search="1"]');
  searchOpeners.forEach((button) => {
    button.addEventListener('click', () => {
      if (!searchOverlay) return;
      searchOverlay.hidden = false;
    });
  });

  searchClosers.forEach((button) => {
    button.addEventListener('click', () => {
      if (!searchOverlay) return;
      searchOverlay.hidden = true;
    });
  });

  if (searchOverlay) {
    searchOverlay.addEventListener('click', (event) => {
      if (event.target === searchOverlay) {
        searchOverlay.hidden = true;
      }
    });
  }

  const main = document.getElementById('mainChart');
  if (main) {
    new Chart(main, {
      type: 'line',
      data: { labels: ['Ene','Feb','Mar','Abr','May','Jun'], datasets: [{ label: 'Usuarios', data: [12,18,17,25,31,40], borderColor: '#F5005F', tension: 0.35 }] },
      options: { plugins: { legend: { display: false } } }
    });
  }
  const state = document.getElementById('stateChart');
  if (state) {
    new Chart(state, {
      type: 'doughnut',
      data: { labels: ['Activos','Inactivos'], datasets: [{ data: [84,16], backgroundColor: ['#F5005F','#FDB0D0'] }] },
      options: { plugins: { legend: { position: 'bottom' } } }
    });
  }
});
