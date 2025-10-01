<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Foto Kartu Pelajar</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f6f8f9;
            --card-bg: #ffffff;
            --text-primary: #1f2937;
            --accent: #dc2626;
            --accent-dark: #b91c1c;
            --border-color: #e5e7eb;
            --radius: 12px;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg);
            color: var(--text-primary);
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            max-width: 800px;
            width: 100%;
            margin: 20px auto;
            background-color: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
            padding: 30px;
            text-align: center;
        }
        .header {
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
        }
        .header h1 {
            font-size: 24px;
            color: var(--accent-dark);
            font-weight: 700;
            margin: 0;
        }
        .image-container {
            margin-bottom: 24px;
        }
        .image-container img {
            max-width: 100%;
            height: auto;
            border-radius: var(--radius);
            border: 1px solid var(--border-color);
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 8px;
            background-color: var(--accent);
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn:hover {
            background-color: var(--accent-dark);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Kartu Pelajar: {{ $user->name }}</h1>
        </div>
        <div class="image-container">
            <img src="{{ Storage::url($user->student_card_photo) }}" alt="Foto Kartu Pelajar">
        </div>
        <a href="{{ route('admin.petugas.verification.index') }}" class="btn">Kembali ke Daftar Verifikasi</a>
    </div>
</body>
</html>
```

---
### Langkah 4: Update Link di Halaman Verifikasi Utama

Terakhir, kita ubah link "Lihat Foto" agar mengarah ke halaman baru kita, bukan membuka tab baru.

1.  Buka file `resources/views/admin/petugas/verification/index.blade.php`.
2.  Cari tag `<a>` untuk "Lihat Foto".
3.  Ubah `href`-nya dan hapus `target="_blank"`.

**Cari baris ini:**
```html
<a href="{{ Storage::url($user->student_card_photo) }}" target="_blank">Lihat Foto</a>
```

**Ubah menjadi seperti ini:**
```html
<a href="{{ route('admin.petugas.verification.showPhoto', $user->id) }}">Lihat Foto</a>
