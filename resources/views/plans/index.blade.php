@extends('layouts.app')

@section('title', 'My Plans - Smart Planner')
@section('page_title', 'Rencana & Jadwal Saya')

@section('content')
    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="rounded-3 d-grid place-items-center bg-primary-subtle text-primary" style="width:46px;height:46px">
                        <i class="bi bi-calendar-week fs-5"></i>
                    </span>
                    <div>
                        <small class="text-muted fw-semibold">Total Rencana</small>
                        <div class="fs-4 fw-bold">{{ $totalPlans }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="rounded-3 d-grid place-items-center bg-success-subtle text-success" style="width:46px;height:46px">
                        <i class="bi bi-check2-circle fs-5"></i>
                    </span>
                    <div>
                        <small class="text-muted fw-semibold">Selesai</small>
                        <div class="fs-4 fw-bold">{{ $completedPlans }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="rounded-3 d-grid place-items-center bg-warning-subtle text-warning" style="width:46px;height:46px">
                        <i class="bi bi-hourglass-split fs-5"></i>
                    </span>
                    <div>
                        <small class="text-muted fw-semibold">Menunggu</small>
                        <div class="fs-4 fw-bold">{{ $pendingPlans }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="rounded-3 d-grid place-items-center bg-info-subtle text-info" style="width:46px;height:46px">
                        <i class="bi bi-lightning-charge fs-5"></i>
                    </span>
                    <div>
                        <small class="text-muted fw-semibold">Produktivitas</small>
                        <div class="fs-4 fw-bold">{{ $productivityRate }}%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-white px-4 py-3 d-flex align-items-center">
            <span class="rounded-circle bg-primary-subtle text-primary d-grid place-items-center me-3" style="width:38px;height:38px">
                <i class="bi bi-plus-lg"></i>
            </span>
            <div>
                <h2 class="h6 fw-bold mb-0">Tambah Rencana Baru</h2>
                <small class="text-muted">Isi detail kegiatan yang ingin dijadwalkan</small>
            </div>
        </div>
        <div class="card-body p-4">
            @if($errors->any())
                <div class="alert alert-danger border-0">
                    <ul class="mb-0 small">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif
            <form action="/plans" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6 col-xl-3">
                        <label class="form-label small fw-bold">Nama Kegiatan</label>
                        <input type="text" name="activity_name" class="form-control" placeholder="Contoh: Belajar Laravel" value="{{ old('activity_name') }}" required>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <label class="form-label small fw-bold">Kota Tujuan</label>
                        <input type="text" name="target_city" class="form-control" placeholder="Contoh: Garut" value="{{ old('target_city') }}" required>
                    </div>
                    <div class="col-md-6 col-xl-2">
                        <label class="form-label small fw-bold">Tanggal</label>
                        <input type="date" name="activity_date" class="form-control" value="{{ old('activity_date') }}" required>
                    </div>
                    <div class="col-md-6 col-xl-2">
                        <label class="form-label small fw-bold">Kategori</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Pilih kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-2">
                        <label class="form-label small fw-bold">Waktu</label>
                        <div class="d-flex gap-2">
                            <input type="time" name="start_time" class="form-control px-2" value="{{ old('start_time', '08:00') }}" required aria-label="Jam mulai">
                            <input type="time" name="end_time" class="form-control px-2" value="{{ old('end_time', '10:00') }}" required aria-label="Jam selesai">
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-plus-circle me-1"></i>Simpan Rencana
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-white px-4 py-3 d-flex align-items-center justify-content-between">
            <div>
                <h2 class="h6 fw-bold mb-0">Daftar Kegiatan</h2>
                <small class="text-muted">{{ $plans->total() }} rencana tercatat</small>
            </div>
            <form action="/plans" method="GET" class="d-flex gap-2">
                <input type="search" name="search" class="form-control form-control-sm" style="width:180px" placeholder="Cari kegiatan..." value="{{ request('search') }}">
                <select name="status" class="form-select form-select-sm" style="width:130px" onchange="this.form.submit()">
                    <option value="">Semua status</option>
                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Selesai</option>
                </select>
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Kegiatan</th>
                            <th>Lokasi</th>
                            <th>Tanggal & Waktu</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($plans as $index => $plan)
                        <tr>
                            <td class="ps-4 text-muted fw-semibold">{{ $plans->firstItem() + $index }}</td>
                            <td>
                                <div class="fw-bold {{ $plan->status == 'Completed' ? 'text-decoration-line-through text-muted' : '' }}">{{ $plan->activity_name }}</div>
                            </td>
                            <td><span class="text-primary"><i class="bi bi-geo-alt-fill me-1"></i>{{ $plan->target_city }}</span></td>
                            <td>
                                <div class="small fw-bold">{{ \Carbon\Carbon::parse($plan->activity_date)->locale('id')->isoFormat('D MMM YYYY') }}</div>
                                <div class="text-muted small"><i class="bi bi-clock me-1"></i>{{ substr($plan->start_time ?? '00:00', 0, 5) }} - {{ substr($plan->end_time ?? '00:00', 0, 5) }}</div>
                            </td>
                            <td>
                                @if($plan->category)
                                    <span class="badge rounded-pill text-primary" style="background:#eef2ff">{{ $plan->category->name }}</span>
                                @else
                                    <span class="badge rounded-pill bg-secondary-subtle text-secondary">Tanpa kategori</span>
                                @endif
                            </td>
                            <td>
                                <form action="/plans/{{ $plan->id }}/toggle" method="POST" class="d-inline">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $plan->status == 'Completed' ? 'btn-success' : 'btn-light border' }}">
                                        @if($plan->status == 'Completed')
                                            <i class="bi bi-check-circle-fill me-1"></i>Selesai
                                        @else
                                            <i class="bi bi-circle me-1"></i>Pending
                                        @endif
                                    </button>
                                </form>
                            </td>
                            <td class="text-center pe-4">
                                <a href="/plans/{{ $plan->id }}/edit" class="btn btn-sm btn-light border" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                <form action="/plans/{{ $plan->id }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus rencana ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border text-danger" title="Hapus"><i class="bi bi-trash3"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-calendar2-x fs-2 text-muted d-block mb-2"></i>
                                <span class="text-muted">Belum ada rencana kegiatan.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($plans->hasPages())
                <div class="px-4 py-3 border-top">{{ $plans->links() }}</div>
            @endif
        </div>
    </div>
@endsection
