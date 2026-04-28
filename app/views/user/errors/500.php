<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terjadi Gangguan</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f8fafc;
            color: #0f172a;
        }
        .wrap {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .card {
            max-width: 560px;
            width: 100%;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 28px;
            text-align: center;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
        }
        h1 { margin-top: 0; color: #b91c1c; }
        p { line-height: 1.6; }
        a {
            display: inline-block;
            margin-top: 14px;
            text-decoration: none;
            background: #0f766e;
            color: #fff;
            padding: 10px 16px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<div class="wrap">
    <div class="card">
        <h1>Terjadi Gangguan</h1>
        <p>Maaf, server sedang mengalami kendala sementara.</p>
        <p>Silakan coba beberapa saat lagi.</p>
        <a href="<?= defined('BASE_URL') ? htmlspecialchars(BASE_URL, ENT_QUOTES, 'UTF-8') : '' ?>/">Kembali ke Beranda</a>
    </div>
</div>
</body>
</html>
