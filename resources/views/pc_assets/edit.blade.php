@extends('layouts.app')

@section('title', 'Edit Aset PC')

@section('content')
<div class="card shadow-sm mx-auto" style="max-width: 720px;">
    <div class="card-header bg-white"><h5 class="mb-0">Edit Aset PC / Laptop</h5></div>
    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">Terdapat kesalahan pada isian, periksa kembali form di bawah.</div>
        @endif

        <form action="{{ route('pc-assets.update', $pcAsset) }}" method="POST">
            @csrf
            @method('PUT') 

            
            @include('pc_assets._form')

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">Update</button>
                <a href="{{ route('pc-assets.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
