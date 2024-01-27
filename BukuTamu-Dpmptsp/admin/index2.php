<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chart PHP</title>
  <!-- Sertakan Chart.js dari CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <!-- Tambahkan elemen canvas untuk chart -->
  <canvas id="myChart" width="400" height="200"></canvas>

  <script>
    // Ambil elemen canvas
    var ctx = document.getElementById('myChart').getContext('2d');

    // Data untuk chart
    var data = {
      labels: ['Ditolak', 'Diterima', 'Menunggu'],
      datasets: [{
        label: 'Status Data',
        data: [5, 8, 3], // Gantilah angka-angka ini dengan data sesuai kebutuhan
        backgroundColor: [
          'rgba(255, 99, 132, 0.7)', // Merah untuk Ditolak
          'rgba(75, 192, 192, 0.7)', // Hijau untuk Diterima
          'rgba(255, 205, 86, 0.7)'  // Kuning untuk Menunggu
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(255, 205, 86, 1)'
        ],
        borderWidth: 1
      }]
    };

    // Konfigurasi chart
    var options = {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    };

    // Buat chart
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: data,
      options: options
    });
  </script>
</body>
</html