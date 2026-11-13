@extends('layouts.app')

@section('title', 'Daftar Aset PC')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2">
        <h5 class="mb-0">Daftar Aset PC / Laptop</h5>
        <a href="{{ route('pc-assets.create') }}" class="btn btn-primary btn-sm">+ Tambah Aset</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>No. Aset</th>
                    <th>Departemen</th>
                    <th>Tipe</th>
                    <th>Merk / Spesifikasi</th>
                    <th>Kondisi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                
                @forelse ($assets as $asset)
                    <tr>
                        
                        <td>{{ $assets->firstItem() + $loop->index }}</td>
                        <td><strong>{{ $asset->nomor_aset }}</strong></td>
                        <td>{{ $asset->nama_departemen }}</td>
                        <td>{{ $asset->tipe_perangkat }}</td>
                        <td>{{ $asset->merk_spesifikasi }}</td>
                        <td>
                            <span class="badge text-bg-{{ $asset->badge_status }}">{{ $asset->status_kondisi }}</span>
                        </td>
                        <td class="text-center text-nowrap">
                            <a href="{{ route('pc-assets.show', $asset) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('pc-assets.edit', $asset) }}" class="btn btn-warning btn-sm">Edit</a>
                            
                            <button type="button" class="btn btn-danger btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#hapusModal{{ $asset->id }}">
                                Hapus
                            </button>
                        </td>
                    </tr>

                    
                    <div class="modal fade" id="hapusModal{{ $asset->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    Yakin ingin menghapus aset <strong>{{ $asset->nomor_aset }}</strong>?
                                    Data yang dihapus tidak dapat dikembalikan.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    
                                    <form action="{{ route('pc-assets.destroy', $asset) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada data aset.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    
    @if ($assets->hasPages())
        <div class="card-footer bg-white">
            {{ $assets->links() }}
        </div>
    @endif
</div>
@endsection
