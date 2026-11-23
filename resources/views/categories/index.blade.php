@extends('layouts.app')

@section('title', 'Kategori - Smart Planner')
@section('page_title', 'Kelola Kategori')

@section('content')
    <div class="card">
        <div class="card-header bg-white px-4 py-3 d-flex align-items-center justify-content-between">
            <div>
                <h2 class="h6 fw-bold mb-1">Daftar Kategori</h2>
                <small class="text-muted">{{ $categories->count() }} kategori tersedia</small>
            </div>
            <a href="/categories/create" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>Tambah Kategori
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4" style="width:90px">No</th>
                            <th>Nama Kategori</th>
                            <th class="text-center pe-4" style="width:180px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $index => $cat)
                        <tr>
                            <td class="ps-4 text-muted fw-semibold">{{ $index + 1 }}</td>
                            <td>
                                <span class="rounded-circle d-inline-grid place-items-center text-primary bg-primary-subtle me-2" style="width:34px;height:34px">
                                    <i class="bi bi-tag-fill"></i>
                                </span>
                                <span class="fw-bold">{{ $cat->name }}</span>
                            </td>
                            <td class="text-center pe-4">
                                <a href="/categories/{{ $cat->id }}/edit" class="btn btn-sm btn-light border" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="/categories/{{ $cat->id }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini? Kegiatan terkait mungkin akan kehilangan kategorinya.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border text-danger" title="Hapus">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">Belum ada kategori.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection