<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="font-family: sans-serif; padding: 20px;">
    <h2>Antrean Kasir</h2>
    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <tr style="background: #f2f2f2;">
            <th>Pasien</th>
            <th>Tgl Berobat</th>
            <th>Aksi</th>
        </tr>
        @foreach ($appointments as $app)
        <tr>
            <td>{{ $app->patient->name }}</td>
            <td>{{ $app->date }}</td>
            <td><a href="/cashier/invoice/{{ $app->id }}">Proses Tagihan</a></td>
        </tr>
        @endforeach
    </table>
</body>
</html>