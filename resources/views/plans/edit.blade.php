@extends('layouts.app')

@section('title', 'Edit Rencana')
@section('page_title', 'Edit Rencana Kegiatan')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header bg-white px-4 py-3">
                    <h2 class="h6 fw-bold mb-1">Ubah Detail Rencana</h2>
                    <small class="text-muted">Perbarui informasi dan jadwal kegiatan</small>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger border-0">
                            <ul class="mb-0 small">
                                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="/plans/{{ $plan->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nama Kegiatan</label>
                                <input type="text" name="activity_name" class="form-control" value="{{ old('activity_name', $plan->activity_name) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Kota Tujuan</label>
                                <input type="text" name="target_city" class="form-control" value="{{ old('target_city', $plan->target_city) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Tanggal Kegiatan</label>
                                <input type="date" name="activity_date" class="form-control" value="{{ old('activity_date', $plan->activity_date) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Kategori</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">Pilih kategori</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id', $plan->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Status</label>
                                <select name="status" class="form-select">
                                    <option value="Pending" {{ old('status', $plan->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Completed" {{ old('status', $plan->status) == 'Completed' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Jam Mulai</label>
                                <input type="time" name="start_time" class="form-control" value="{{ old('start_time', substr($plan->start_time ?? '08:00', 0, 5)) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Jam Selesai</label>
                                <input type="time" name="end_time" class="form-control" value="{{ old('end_time', substr($plan->end_time ?? '10:00', 0, 5)) }}" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="/plans" class="btn btn-light border px-4">Kembali</a>
                            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i>Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection