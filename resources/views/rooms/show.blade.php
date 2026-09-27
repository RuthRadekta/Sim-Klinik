@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold"><i class="bi bi-door-open"></i> {{ $room->name }} ({{ $room->type }})</h5>
    <a href="/rooms" class="btn btn-secondary btn-sm">Kembali</a>
</div>

<div class="d-flex flex-wrap gap-3">
    @foreach($room->beds as $bed)
        <!-- Wujud Kotak Bed (Beda Warna Tegas) -->
        <div class="card text-center shadow-sm position-relative 
             {{ $bed->status == 'Tersedia' ? 'bg-white border-2 border-success text-success' : 'bg-danger border-0 text-white' }}" 
             style="width: 120px; height: 120px; cursor: pointer; transition: transform 0.2s;" 
             onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'"
             data-bs-toggle="modal" data-bs-target="#modalBed{{ $bed->id }}">
            
            @if(Auth::user()->role == 'admin' && $bed->status == 'Tersedia')
                <form action="/beds/{{ $bed->id }}" method="POST" class="position-absolute top-0 end-0 m-1" onsubmit="return confirm('Hapus bed ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm text-danger p-0 border-0" onclick="event.stopPropagation()"><i class="bi bi-trash-fill"></i></button>
                </form>
            @endif

            <div class="card-body d-flex flex-column justify-content-center align-items-center p-2">
                <h6 class="fw-bold mb-1">{{ $bed->name }}</h6>
                @if($bed->status == 'Tersedia')
                    <i class="bi bi-check-circle-fill fs-3"></i>
                    <small class="mt-1 fw-bold">TERSEDIA</small>
                @else
                    <i class="bi bi-person-bed fs-3"></i>
                    <small class="text-truncate w-100 d-block mt-1 fw-bold" style="font-size: 0.75rem;">{{ $bed->patient->name }}</small>
                @endif
            </div>
        </div>

        <!-- MODAL POP-UP -->
        <div class="modal fade text-dark" id="modalBed{{ $bed->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Manajemen {{ $bed->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        @if($bed->status == 'Tersedia')
                            <div class="alert alert-success"><i class="bi bi-info-circle"></i> Kamar ini kosong dan siap digunakan.</div>
                            @if(Auth::user()->role != 'admin')
                                <form action="/beds/{{ $bed->id }}/book" method="POST">
                                    @csrf
                                    <label class="form-label fw-bold">Pilih Pasien Terdaftar:</label>
                                    <!-- Tambahkan data-modal-id agar JS tahu ini milik modal mana -->
                                    <select name="patient_id" class="form-select select2-modal" data-modal-id="#modalBed{{ $bed->id }}" required style="width: 100%;">
                                        <option value="">-- Ketik Nama atau NIK Pasien --</option>
                                        @foreach($patients as $patient)
                                            <option value="{{ $patient->id }}">{{ $patient->name }} ({{ $patient->nik }})</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary w-100 mt-3"><i class="bi bi-journal-check"></i> Booking Kamar Ini</button>
                                </form>
                            @endif
                        @else
                            <div class="alert alert-danger"><i class="bi bi-x-circle"></i> Kamar sedang digunakan.</div>
                            <table class="table table-sm table-borderless">
                                <tr><th width="35%">Nama Pasien</th><td class="fw-bold">: {{ $bed->patient->name }}</td></tr>
                                <tr><th>NIK</th><td>: {{ $bed->patient->nik }}</td></tr>
                                <tr><th>Waktu Masuk</th><td>: {{ \Carbon\Carbon::parse($bed->check_in_time)->format('d F Y, H:i') }}</td></tr>
                            </table>
                            
                            @if(Auth::user()->role != 'admin')
                                <form action="/beds/{{ $bed->id }}/checkout" method="POST" onsubmit="return confirm('Selesaikan rawat inap dan lempar tagihan ke kasir?')">
                                    @csrf
                                    <button type="submit" class="btn btn-warning w-100 fw-bold mt-2">Selesai & Proses Tagihan Kasir</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection