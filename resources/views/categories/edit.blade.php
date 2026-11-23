@extends('layouts.app')

@section('title', 'Edit Kategori')
@section('page_title', 'Edit Kategori')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header bg-white px-4 py-3">
                    <h2 class="h6 fw-bold mb-1">Ubah Nama Kategori</h2>
                    <small class="text-muted">Perbarui nama kategori yang dipilih</small>
                </div>
                <div class="card-body p-4">
                    <form action="/categories/{{ $category->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="form-label fw-bold">Nama Kategori</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                            @error('name')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="/categories" class="btn btn-light border px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection