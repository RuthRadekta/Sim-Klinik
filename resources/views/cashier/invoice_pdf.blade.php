<!DOCTYPE html>
<html>
<head>
    <title>Invoice Pembayaran</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .info { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .text-right { text-align: right; }
        .total-row { font-weight: bold; background-color: #f9f9f9; }
    </style>
</head>
<body>
    <div class="header">
        <h2>INVOICE KLINIK</h2>
        <p>Sistem Informasi Manajemen Klinik<br>Tanggal Cetak: {{ date('d F Y, H:i') }}</p>
    </div>
    
    <div class="info">
        <strong>Pasien:</strong> {{ $appointment->patient->name }} (NIK: {{ $appointment->patient->nik }})<br>
        <strong>Dokter:</strong> {{ $appointment->doctor->user->name }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Deskripsi Layanan & Obat</th>
                <th style="width:50px; text-align:center;">Qty</th>
                <th class="text-right" style="width:120px;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <!-- Jasa Dokter -->
            <tr>
                <td>Jasa Konsultasi Medis</td>
                <td style="text-align:center;">1</td>
                <td class="text-right">Rp {{ number_format($doctorFee, 0, ',', '.') }}</td>
            </tr>
            <!-- Obat -->
            @if($appointment->medicalRecord)
                @foreach($appointment->medicalRecord->prescriptions as $resep)
                <tr>
                    <td>{{ $resep->medicine->name }} ({{ $resep->dosage }})</td>
                    <td style="text-align:center;">{{ $resep->quantity }}</td>
                    <td class="text-right">Rp {{ number_format($resep->quantity * $resep->medicine->price, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="2" class="text-right">GRAND TOTAL</td>
                <td class="text-right">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>