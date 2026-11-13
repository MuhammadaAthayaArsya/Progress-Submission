
@php
    $nilai = fn (string $kolom, $default = '') => old($kolom, isset($pcAsset) ? $pcAsset->$kolom : $default);
@endphp

<div class="mb-3">
    <label for="nomor_aset" class="form-label">Nomor Aset</label>
    <input type="text" id="nomor_aset" name="nomor_aset" maxlength="30"
           class="form-control @error('nomor_aset') is-invalid @enderror"
           placeholder="contoh: AST-HRD-002" value="{{ $nilai('nomor_aset') }}">
    @error('nomor_aset') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="nama_departemen" class="form-label">Departemen</label>
    <input type="text" id="nama_departemen" name="nama_departemen" list="saran-departemen" maxlength="100"
           class="form-control @error('nama_departemen') is-invalid @enderror"
           placeholder="contoh: HRD" value="{{ $nilai('nama_departemen') }}">
    <datalist id="saran-departemen">
        @foreach (\App\Models\PcAsset::SARAN_DEPARTEMEN as $dept)
            <option value="{{ $dept }}">
        @endforeach
    </datalist>
    @error('nama_departemen') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="tipe_perangkat" class="form-label">Tipe Perangkat</label>
        <select id="tipe_perangkat" name="tipe_perangkat"
                class="form-select @error('tipe_perangkat') is-invalid @enderror">
            <option value="">-- Pilih tipe --</option>
            @foreach (\App\Models\PcAsset::TIPE_PERANGKAT as $tipe)
                <option value="{{ $tipe }}" @selected($nilai('tipe_perangkat') === $tipe)>{{ $tipe }}</option>
            @endforeach
        </select>
        @error('tipe_perangkat') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="status_kondisi" class="form-label">Status Kondisi</label>
        <select id="status_kondisi" name="status_kondisi"
                class="form-select @error('status_kondisi') is-invalid @enderror">
            @foreach (\App\Models\PcAsset::STATUS_KONDISI as $status)
                <option value="{{ $status }}" @selected($nilai('status_kondisi', 'Baik') === $status)>{{ $status }}</option>
            @endforeach
        </select>
        @error('status_kondisi') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="mb-3">
    <label for="merk_spesifikasi" class="form-label">Merk / Spesifikasi</label>
    <textarea id="merk_spesifikasi" name="merk_spesifikasi" rows="2" maxlength="255"
              class="form-control @error('merk_spesifikasi') is-invalid @enderror"
              placeholder="contoh: Lenovo ThinkPad E14, Core i5, RAM 8GB">{{ $nilai('merk_spesifikasi') }}</textarea>
    @error('merk_spesifikasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-4">
    <label for="nomor_seri" class="form-label">Nomor Seri</label>
    <input type="text" id="nomor_seri" name="nomor_seri" maxlength="60"
           class="form-control @error('nomor_seri') is-invalid @enderror"
           value="{{ $nilai('nomor_seri') }}">
    @error('nomor_seri') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
