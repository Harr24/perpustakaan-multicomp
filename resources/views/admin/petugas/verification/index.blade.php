<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pendaftar</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff;
            color: #333;
            margin: 20px;
        }

        h1 {
            color: #d32f2f;
            border-bottom: 2px solid #d32f2f;
            padding-bottom: 10px;
        }

        .nav-links {
            margin-bottom: 20px;
        }

        .nav-links a {
            text-decoration: none;
            color: #d32f2f;
            font-weight: bold;
            padding: 8px 16px;
            border: 1px solid #d32f2f;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }

        .nav-links a:hover {
            background-color: #fbe9e7;
        }

        .success-message {
            color: green;
            margin-bottom: 15px;
        }

        .verification-table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .verification-table th, .verification-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .verification-table th {
            background-color: #d32f2f;
            color: white;
        }

        .verification-table tr:hover {
            background-color: #f9f9f9;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .action-buttons button {
            padding: 6px 12px;
            border-radius: 4px;
            border: none;
            font-size: 0.9rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-approve {
            background-color: #d32f2f;
            color: white;
        }

        .btn-approve:hover {
            background-color: #b71c1c;
        }

        .btn-reject {
            background-color: white;
            color: #d32f2f;
            border: 1px solid #d32f2f;
        }

        .btn-reject:hover {
            background-color: #fbe9e7;
        }

        a.view-photo {
            color: #d32f2f;
            font-weight: bold;
            text-decoration: none;
        }

        a.view-photo:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .verification-table, .verification-table thead, .verification-table tbody, .verification-table th, .verification-table td, .verification-table tr {
                display: block;
            }

            .verification-table tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                padding: 10px;
            }

            .verification-table td {
                padding: 8px 0;
            }

            .verification-table td::before {
                content: attr(data-label);
                font-weight: bold;
                display: block;
                color: #d32f2f;
            }
        }
    </style>
</head>
<body>

    <h1>Daftar Siswa Menunggu Verifikasi</h1>

    <div class="nav-links">
        <a href="{{ route('dashboard') }}">Kembali ke Dashboard</a>
    </div>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <table class="verification-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Kartu Pelajar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pendingUsers as $user)
                <tr>
                    <td data-label="Nama">{{ $user->name }}</td>
                    <td data-label="Email">{{ $user->email }}</td>
                    <td data-label="Kartu Pelajar">
                        <a href="{{ Storage::url($user->student_card_photo) }}" target="_blank" class="view-photo">Lihat Foto</a>
                    </td>
                    <td data-label="Aksi">
                        <div class="action-buttons">
                            <form action="{{ route('admin.petugas.verification.approve', $user) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-approve">ACC</button>
                            </form>
                            <form action="{{ route('admin.petugas.verification.reject', $user) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-reject">Tolak</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Tidak ada pendaftar baru.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
