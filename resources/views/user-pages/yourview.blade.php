<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Data Penerbangan</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <button id="downloadButton">Download Penerbangan</button>

    <script>
        $(document).ready(function() {
            $('#downloadButton').on('click', function() {
                $.ajax({
                    url: '/download-penerbangan',
                    type: 'GET',
                    success: function(response) {
                        // Membuat link sementara untuk mendownload file
                        var blob = new Blob([response], { type: 'text/csv' });
                        var link = document.createElement('a');
                        link.href = URL.createObjectURL(blob);
                        link.download = 'penerbangan.csv'; // Nama file yang akan di-download
                        link.click(); // Memulai download
                    },
                    error: function(xhr, status, error) {
                        alert('Error saat mencoba mendownload file.');
                    }
                });
            });
        });
    </script>
</body>
</html>
