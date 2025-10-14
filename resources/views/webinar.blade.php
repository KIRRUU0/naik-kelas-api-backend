<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin Naik Kelas</title>
    <style>
        /* ... CSS Sederhana ... */
    </style>
</head>
<body>
    <h1>Dashboard Admin Naik Kelas</h1>
    <h2>Data Webinars</h2>
    
    <div id="loading">Memuat data dari API...</div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul Webinar</th>
                <th>Mentor</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="webinar-list"></tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const webinarList = document.getElementById('webinar-list');
            const loading = document.getElementById('loading');
            
            // Panggil API GET /api/webinar
            fetch('/api/webinar')
                .then(response => response.json())
                .then(data => {
                    loading.style.display = 'none';
                    if (data.data && data.data.length > 0) {
                        data.data.forEach(webinar => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${webinar.id}</td>
                                <td>${webinar.judul_webinar}</td>
                                <td>${webinar.nama_mentor}</td>
                                <td>${webinar.status_acara == 1 ? 'Aktif' : 'Selesai'}</td>
                            `;
                            webinarList.appendChild(row);
                        });
                    } else {
                        webinarList.innerHTML = '<tr><td colspan="4">Tidak ada data webinar.</td></tr>';
                    }
                })
                .catch(error => {
                    loading.textContent = `Gagal memuat data: ${error.message}`;
                });
        });
        fetch ('/api/webinar/statistik')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('statusChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: stats.labels, // ['Selesai', 'Aktif']
                    datasets: [{
                        data: stats.data, 
                        backgroundColor: ['#ff6384', '#36a2eb']
                    }]
                },
                options: {  
                    responsive: true
                })
        });
    </script>
</body>
</html>