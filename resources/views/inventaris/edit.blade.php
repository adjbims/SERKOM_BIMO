@extends('layouts.app')

@section('title', 'Edit Barang: ' . $item->nama_barang)
@section('header', 'Form Edit Barang')

@section('content')
<div class="card shadow-sm">
    <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Tambah Data Barang</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('items.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $item->nama_barang) }}" required>
                @error('nama_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deskrispi" class="form-label">deskrispi</label>
                <textarea class="form-control @error('deskrispi') is-invalid @enderror" id="deskrispi" name="deskrispi" rows="3">{{ old('deskrispi', $item->deskrispi) }}</textarea>
                @error('deskrispi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="jumlah" class="form-label">Jumlah <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah', $item->jumlah) }}" required min="0">
                    @error('jumlah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
              <div class="col-md-6 mb-3"></div>
 <div class="col-md-6 mb-3">
                    <label for="harga" class="form-label">Harga (Rp)</label>
                    <input type="number" step="1" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $item->harga) }}" min="0" placeholder="Contoh: 50000">
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save-fill"></i> Simpan Perubahan</button>
                <a href="{{ route('items.index') }}" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection