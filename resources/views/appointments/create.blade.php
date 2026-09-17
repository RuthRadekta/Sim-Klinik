<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Jadwal Berobat - SIM Klinik</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        select, input, button { padding: 8px; width: 300px; }
        button { background-color: #007BFF; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    
    <h2>Form Pendaftaran Pasien</h2>

    <!-- Method POST diarahkan ke endpoint /appointments -->
    <form action="/appointments" method="POST">
        @csrf <!-- Wajib ada di Laravel untuk keamanan form -->

        <div class="form-group">
            <label>Pilih Pasien:</label>
            <select name="patient_id" required>
                <option value="">-- Pilih Pasien --</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->nik }} - {{ $patient->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Pilih Dokter:</label>
            <select name="doctor_id" required>
                <option value="">-- Pilih Dokter --</option>
                @foreach($doctors as $doctor)
                    <!-- Kita mengambil nama dari relasi tabel user -->
                    <option value="{{ $doctor->id }}">{{ $doctor->user->name }} ({{ $doctor->specialization }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Berobat:</label>
            <input type="date" name="date" required>
        </div>

        <button type="submit">Buat Jadwal & Ambil Antrean</button>
    </form>

</body>
</html>