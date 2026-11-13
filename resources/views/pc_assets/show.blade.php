@extends('layouts.app')

@section('title', 'Detail Aset PC')

@section('content')
<div class="card shadow-sm mx-auto" style="max-width: 720px;">
    <div class="card-header bg-white"><h5 class="mb-0">Detail Aset: {{ $pcAsset->nomor_aset }}</h5></div>
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-4">Nomor Aset</dt>
            <dd class="col-sm-8">{{ $pcAsset->nomor_aset }}</dd>

            <dt class="col-sm-4">Departemen</dt>
            <dd class="col-sm-8">{{ $pcAsset->nama_departemen }}</dd>

            <dt class="col-sm-4">Tipe Perangkat</dt>
            <dd class="col-sm-8">{{ $pcAsset->tipe_perangkat }}</dd>

            <dt class="col-sm-4">Merk / Spesifikasi</dt>
            <dd class="col-sm-8">{{ $pcAsset->merk_spesifikasi }}</dd>

            <dt class="col-sm-4">Nomor Seri</dt>
            <dd class="col-sm-8"><code>{{ $pcAsset->nomor_seri }}</code></dd>

            <dt class="col-sm-4">Status Kondisi</dt>
            <dd class="col-sm-8">
                <span class="badge text-bg-{{ $pcAsset->badge_status }}">{{ $pcAsset->status_kondisi }}</span>
            </dd>

            <dt class="col-sm-4">Dibuat</dt>
            <dd class="col-sm-8">{{ $pcAsset->created_at?->format('d M Y H:i') }}</dd>

            <dt class="col-sm-4">Terakhir diubah</dt>
            <dd class="col-sm-8">{{ $pcAsset->updated_at?->format('d M Y H:i') }}</dd>
        </dl>
    </div>
    <div class="card-footer bg-white d-flex gap-2">
        <a href="{{ route('pc-assets.edit', $pcAsset) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('pc-assets.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</div>
@endsection
