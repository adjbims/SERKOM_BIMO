@extends('layouts.app')

@section('title', 'Tambah Barang Baru')
@section('header')
    <span style="color: #333;">Form Tambah Barang Baru</span>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Tambah Data Barang</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('items.store') }}" method="POST" novalidate>
            @csrf
            
            <div class="mb-4">
                <label for="nama_barang" class="form-label fw-bold">Nama Barang <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" required placeholder="Masukkan nama barang">
                @error('nama_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="deskrispi" class="form-label fw-bold">Deskripsi</label>
                <textarea class="form-control @error('deskrispi') is-invalid @enderror" id="deskrispi" name="deskrispi" rows="4" placeholder="Deskripsikan barang">{{ old('deskrispi') }}</textarea>
                @error('deskrispi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label for="jumlah" class="form-label fw-bold">Jumlah <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" required min="0" placeholder="0">
                    @error('jumlah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
               
            </div>
 <div class="row g-3 mb-4"></div>
  <div class="col-md-6">
                    <label for="harga" class="form-label fw-bold">Harga (Rp)</label>
                    <input type="number" step="1" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') }}" min="0" placeholder="Contoh: 50000">
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                <br>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success"><i class="bi bi-save-fill"></i> Simpan Barang</button>
                <a href="{{ route('items.index') }}" class="btn btn-outline-secondary"><i class="bi bi-x-circle"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
