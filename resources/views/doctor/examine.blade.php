<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Periksa Pasien - SIM Klinik</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .info-box { background: #f9f9f9; padding: 15px; border-left: 5px solid #007BFF; margin-bottom: 20px; }
        textarea, button { width: 100%; max-width: 500px; margin-bottom: 15px; }
        textarea { height: 100px; padding: 10px; }
        button { background-color: #007BFF; color: white; padding: 10px; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <h2>Form Rekam Medis (EHR)</h2>

    <div class="info-box">
        <p><strong>Nama Pasien:</strong> {{ $appointment->patient->name }}</p>
        <p><strong>Riwayat Alergi:</strong> <span style="color:red">{{ $appointment->patient->allergy_history ?? 'Tidak ada' }}</span></p>
    </div>

    <form action="/doctor/examine/{{ $appointment->id }}" method="POST">
        @csrf
        
        <label><strong>Diagnosa Penyakit:</strong></label><br>
        <textarea name="diagnosis" required placeholder="Contoh: Radang tenggorokan (Faringitis)..."></textarea><br>

        <label><strong>Catatan Tambahan (Opsional):</strong></label><br>
        <textarea name="notes" placeholder="Contoh: Pasien butuh istirahat 2 hari..."></textarea><br>

        <hr>
        <h3>Resep Obat (Opsional)</h3>
        <div style="margin-bottom: 20px; background: #f1f1f1; padding: 15px;">
            <label>Pilih Obat:</label>
            <select name="medicine_id[]">
                <option value="">-- Tidak Ada Obat --</option>
                @foreach($medicines as $med)
                    <option value="{{ $med->id }}">{{ $med->name }} (Sisa Stok: {{ $med->stock }})</option>
                @endforeach
            </select>
            
            <input type="text" name="dosage[]" placeholder="Dosis (Contoh: 3x1)" style="width: 150px;">
            <input type="number" name="quantity[]" placeholder="Jumlah" style="width: 100px;" min="1">
            
            <p style="font-size: 12px; color: gray;">*Untuk saat ini kita buat form untuk 1 jenis obat dulu.</p>
        </div>
        
        <button type="submit">Simpan Diagnosa & Selesaikan Pemeriksaan</button>
    </form>

</body>
</html>