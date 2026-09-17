<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="font-family: sans-serif; padding: 20px;">
    <h2>Rincian Tagihan: {{ $appointment->patient->name }}</h2>
    
    <div style="background: #f9f9f9; padding: 15px; width: 400px;">
        <p><strong>Jasa Dokter ({{ $appointment->doctor->user->name }}):</strong> Rp {{ number_format($doctorFee, 0, ',', '.') }}</p>
        
        <hr>
        <p><strong>Rincian Obat:</strong></p>
        <ul>
            @if($appointment->medicalRecord)
                @foreach($appointment->medicalRecord->prescriptions as $resep)
                    <li>{{ $resep->medicine->name }} (x{{ $resep->quantity }}) : Rp {{ number_format($resep->quantity * $resep->medicine->price, 0, ',', '.') }}</li>
                @endforeach
            @endif
        </ul>
        <p><strong>Total Obat:</strong> Rp {{ number_format($medicineTotal, 0, ',', '.') }}</p>

        <hr>
        <h3 style="color: green;">Total Bayar: Rp {{ number_format($grandTotal, 0, ',', '.') }}</h3>

        <form action="/cashier/pay/{{ $appointment->id }}" method="POST">
            @csrf
            <input type="hidden" name="grand_total" value="{{ $grandTotal }}">
            <button type="submit" style="background: green; color: white; padding: 10px; width: 100%; border: none; cursor: pointer;">Konfirmasi Pembayaran Lunas</button>
        </form>
    </div>
</body>
</html>