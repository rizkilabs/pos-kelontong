<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Kelontong</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container">
        @if (session('success'))
        <div id="success-notification" class="alert alert-success alert-dismissible fade show m-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if (session('error'))
        <div id="error-notification" class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successNotification = document.getElementById('success-notification');
            const errorNotification = document.getElementById('error-notification');

            if (successNotification) {
                setTimeout(function() {
                    successNotification.classList.remove('show'); // Hilangkan kelas 'show' untuk memicu transisi fade out Bootstrap
                    setTimeout(function() {
                        successNotification.remove(); // Hapus elemen setelah transisi selesai (opsional, tergantung preferensi)
                    }, 500); // Waktu transisi Bootstrap (biasanya 0.15s atau 0.3s, sesuaikan jika perlu)
                }, 3000);
            }

            if (errorNotification) {
                setTimeout(function() {
                    errorNotification.classList.remove('show'); // Hilangkan kelas 'show'
                    setTimeout(function() {
                        errorNotification.remove();
                    }, 500);
                }, 3000);
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>