@extends('layouts.app')

@section('title', 'Daftar Barang')
@section('header', '📦 Daftar Barang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('items.create') }}" class="btn btn-success btn-sm shadow-sm me-2">
            <i class="bi bi-plus-circle me-1"></i> Tambah Barang
        </a>
        <a href="{{ route('items.downloadPdf') }}" class="btn btn-danger btn-sm shadow-sm">
            <i class="bi bi-file-earmark-pdf-fill me-1"></i> Unduh PDF
        </a>
    </div>
</div>

<form action="{{ route('items.index') }}" method="GET" class="mb-3">
    <input type="text" name="search" value="{{ old('search', $search ?? '') }}" placeholder="Cari nama atau deskripsi..." class="form-control" />
    <button type="submit" class="btn btn-primary mt-2">Cari</button>
</form>

@if($items->isEmpty())
    <div class="alert alert-warning text-center shadow-sm" role="alert">
        <i class="bi bi-exclamation-circle-fill me-2"></i>Belum ada barang dalam inventaris. Silakan tambahkan terlebih dahulu.
    </div>
@else
    <div class="table-responsive shadow rounded">
        <table class="table table-hover table-bordered table-striped align-middle bg-white" id="itemsTable">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Deskripsi</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Tanggal Dibuat</th>      
                    <th>Terakhir Diperbarui</th> 
                    <th style="width: 170px;">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach ($items as $item)
                <tr>
                    <td class="text-center">{{ $item->id }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ Str::limit($item->deskrispi, 60) ?: '-' }}</td>
                    <td class="text-center">{{ $item->jumlah }}</td>
                    <td class="text-end">Rp {{ number_format($item->harga, 0, ',', '.') ?: '-' }}</td>
                    <td class="text-center">{{ $item->created_at->format('d-m-Y H:i') }}</td>  
                    <td class="text-center">{{ $item->updated_at->format('d-m-Y H:i') }}</td> 
                    <td class="text-center">
                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm me-1">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus {{ $item->nama_barang }}?')">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Buttons -->
    <div id="pagination" class="mt-3 d-flex justify-content-center"></div>

    <!-- JS Pagination Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const rowsPerPage = 5;
            const tableBody = document.getElementById("tableBody");
            const rows = tableBody.querySelectorAll("tr");
            const totalPages = Math.ceil(rows.length / rowsPerPage);
            const pagination = document.getElementById("pagination");

            function showPage(page) {
                let start = (page - 1) * rowsPerPage;
                let end = start + rowsPerPage;
                rows.forEach((row, index) => {
                    row.style.display = index >= start && index < end ? "" : "none";
                });

                // Update active button
                Array.from(pagination.children).forEach(btn => btn.classList.remove("active"));
                pagination.children[page - 1]?.classList.add("active");
            }

            function createPaginationButtons() {
                for (let i = 1; i <= totalPages; i++) {
                    let button = document.createElement("button");
                    button.textContent = i;
                    button.classList.add("btn", "btn-sm", "btn-outline-primary", "me-1");
                    button.addEventListener("click", () => showPage(i));
                    pagination.appendChild(button);
                }
            }

            if (rows.length > 0) {
                createPaginationButtons();
                showPage(1);
            }
        });
    </script>
@endif
@endsection
