@extends('admin.layout')

@section('title', 'Review Nailist - ' . $nailist->name)

@section('content')
<div class="container-fluid px-4">
    <!-- Back Button & Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('admin.nailists.index', ['status' => 'pending']) }}" class="btn btn-outline-secondary btn-sm mb-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h1 class="h3 mb-0 text-gray-800">Review Nailist</h1>
        </div>
        <div>
            @if($nailist->is_nailist_approved === null)
                <span class="badge badge-warning badge-lg"><i class="fas fa-clock"></i> Pending Review</span>
            @elseif($nailist->is_nailist_approved)
                <span class="badge badge-success badge-lg"><i class="fas fa-check-circle"></i> Approved</span>
            @else
                <span class="badge badge-danger badge-lg"><i class="fas fa-times-circle"></i> Rejected</span>
            @endif
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        <!-- Left Column: Nailist Profile -->
        <div class="col-lg-4 mb-4">
            <!-- Profile Card -->
            <div class="card shadow mb-4">
                <div class="card-header bg-gradient-primary text-white">
                    <h6 class="m-0 font-weight-bold">Informasi Nailist</h6>
                </div>
                <div class="card-body text-center">
                    <div class="avatar-circle-large bg-gradient-primary text-white mx-auto mb-3">
                        {{ substr($nailist->name, 0, 1) }}
                    </div>
                    <h5 class="font-weight-bold">{{ $nailist->salon_name ?? $nailist->name }}</h5>
                    <p class="text-muted mb-3">{{ $nailist->name }}</p>

                    @if($nailist->address)
                    <div class="mb-3">
                        <i class="fas fa-map-marker-alt text-pink-600 mr-2"></i>
                        <span class="text-muted">{{ $nailist->address }}</span>
                    </div>
                    @endif

                    @if($nailist->bio)
                    <div class="text-left mb-3">
                        <h6 class="font-weight-bold">Bio:</h6>
                        <p class="text-muted small">{{ $nailist->bio }}</p>
                    </div>
                    @endif

                    <hr>

                    <div class="text-left">
                        <h6 class="font-weight-bold mb-3">Kontak:</h6>
                        @if($nailist->whatsapp)
                        <div class="mb-2">
                            <i class="fab fa-whatsapp text-success fa-lg"></i>
                            <span class="ml-2">{{ $nailist->whatsapp }}</span>
                        </div>
                        @endif
                        @if($nailist->instagram)
                        <div class="mb-2">
                            <i class="fab fa-instagram text-danger fa-lg"></i>
                            <span class="ml-2">{{ '@' . $nailist->instagram }}</span>
                        </div>
                        @endif
                        @if($nailist->phone)
                        <div class="mb-2">
                            <i class="fas fa-phone text-info fa-lg"></i>
                            <span class="ml-2">{{ $nailist->phone }}</span>
                        </div>
                        @endif
                        @if($nailist->email)
                        <div class="mb-2">
                            <i class="fas fa-envelope text-secondary fa-lg"></i>
                            <span class="ml-2">{{ $nailist->email }}</span>
                        </div>
                        @endif
                    </div>

                    <hr>

                    <div class="text-left">
                        <h6 class="font-weight-bold mb-3">Status:</h6>
                        <div class="mb-2">
                            <small class="text-muted">Terdaftar:</small>
                            <div class="font-weight-bold">{{ $nailist->created_at->format('d F Y') }}</div>
                            <small class="text-muted">{{ $nailist->created_at->diffForHumans() }}</small>
                        </div>
                        @if($nailist->approved_at)
                        <div class="mb-2 mt-3">
                            <small class="text-muted">Approved:</small>
                            <div class="font-weight-bold">{{ $nailist->approved_at->format('d F Y') }}</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Statistics Card -->
            <div class="card shadow">
                <div class="card-header bg-gradient-info text-white">
                    <h6 class="m-0 font-weight-bold">Statistik</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="text-primary font-weight-bold" style="font-size: 24px;">{{ $stats['total_catalogs'] }}</div>
                            <div class="text-muted small">Desain</div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="text-info font-weight-bold" style="font-size: 24px;">{{ number_format($stats['total_views']) }}</div>
                            <div class="text-muted small">Views</div>
                        </div>
                        <div class="col-6">
                            <div class="text-success font-weight-bold" style="font-size: 24px;">{{ $stats['total_reviews'] }}</div>
                            <div class="text-muted small">Reviews</div>
                        </div>
                        <div class="col-6">
                            <div class="text-warning font-weight-bold" style="font-size: 24px;">{{ number_format($stats['average_rating'], 1) }}</div>
                            <div class="text-muted small">Rating</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Actions & Catalogs -->
        <div class="col-lg-8">
            <!-- Action Buttons Card -->
            <div class="card shadow mb-4">
                <div class="card-header bg-gradient-warning text-white">
                    <h6 class="m-0 font-weight-bold">Aksi Review</h6>
                </div>
                <div class="card-body">
                    @if($nailist->is_nailist_approved === null)
                        <!-- Pending: Show Approve/Reject -->
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <form action="{{ route('admin.nailists.approve', $nailist->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-block btn-lg" onclick="return confirm('Approve nailist ini? Mereka akan bisa mempublikasikan katalog.')">
                                        <i class="fas fa-check-circle"></i> Approve Nailist
                                    </button>
                                </form>
                                <small class="text-muted">Nailist akan dapat mempublikasikan katalog desain</small>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger btn-block btn-lg" data-toggle="modal" data-target="#rejectModal">
                                    <i class="fas fa-times-circle"></i> Reject Nailist
                                </button>
                                <small class="text-muted">Nailist tidak akan bisa publish katalog</small>
                            </div>
                        </div>
                    @elseif($nailist->is_nailist_approved)
                        <!-- Approved: Show Reset Option -->
                        <div class="alert alert-success mb-3">
                            <i class="fas fa-check-circle"></i> <strong>Nailist Approved</strong>
                            <p class="mb-0 small">Approved pada {{ $nailist->approved_at ? $nailist->approved_at->format('d F Y, H:i') : '-' }}</p>
                        </div>
                        <form action="{{ route('admin.nailists.reset', $nailist->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Reset status approval ke pending?')">
                                <i class="fas fa-undo"></i> Reset ke Pending
                            </button>
                        </form>
                    @else
                        <!-- Rejected: Show Reason & Reset -->
                        <div class="alert alert-danger mb-3">
                            <i class="fas fa-times-circle"></i> <strong>Nailist Rejected</strong>
                            @if($nailist->rejection_reason)
                            <hr>
                            <p class="mb-0"><strong>Alasan:</strong></p>
                            <p class="mb-0">{{ $nailist->rejection_reason }}</p>
                            @endif
                        </div>
                        <form action="{{ route('admin.nailists.reset', $nailist->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Reset status approval ke pending?')">
                                <i class="fas fa-undo"></i> Reset ke Pending
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Catalogs Card -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Katalog Desain ({{ $nailist->catalogs->count() }})</h6>
                </div>
                <div class="card-body">
                    @if($nailist->catalogs->count() > 0)
                        <div class="row">
                            @foreach($nailist->catalogs as $catalog)
                            <div class="col-md-6 mb-4">
                                <div class="card border-left-primary h-100">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-4">
                                                @if($catalog->images && count($catalog->images) > 0)
                                                    @php
                                                        $raw = $catalog->images[0] ?? null;
                                                        $img = $raw;
                                                        if (is_string($img)) {
                                                            // remove surrounding quotes/brackets and escaped slashes
                                                            $img = trim($img);
                                                            $img = trim($img, "\"'[] ");
                                                            $img = str_replace('\\', '', $img);
                                                        }
                                                        // If it's already a full URL (after sanitizing), use it directly. Otherwise assume storage path.
                                                        if ($img && filter_var($img, FILTER_VALIDATE_URL)) {
                                                            $thumbUrl = $img;
                                                        } else {
                                                            $thumbUrl = $img ? asset('storage/' . $img) : null;
                                                        }
                                                    @endphp
                                                    <img src="{{ $thumbUrl }}" class="img-fluid rounded" alt="{{ $catalog->title }}">
                                                @else
                                                    <div class="bg-gradient-primary text-white rounded d-flex align-items-center justify-content-center" style="height: 80px;">
                                                        <i class="fas fa-image fa-2x"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-8">
                                                <h6 class="font-weight-bold mb-1">{{ $catalog->title }}</h6>
                                                <div class="small text-muted mb-2">{{ $catalog->category }}</div>
                                                <div class="d-flex align-items-center small">
                                                    <span class="mr-3">
                                                        <i class="fas fa-eye text-info"></i> {{ $catalog->view_count }}
                                                    </span>
                                                    <span class="mr-3">
                                                        <i class="fas fa-star text-warning"></i> {{ number_format($catalog->average_rating, 1) }}
                                                    </span>
                                                    <span class="badge badge-{{ $catalog->is_active ? 'success' : 'secondary' }}">
                                                        {{ $catalog->is_active ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-image fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada katalog desain</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.nailists.reject', $nailist->id) }}" method="POST">
                @csrf
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Reject Nailist</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Anda akan menolak <strong>{{ $nailist->name }}</strong> sebagai nailist.</p>
                    <div class="form-group">
                        <label for="rejection_reason">Alasan Penolakan <span class="text-danger">*</span></label>
                        <textarea
                            name="rejection_reason"
                            id="rejection_reason"
                            class="form-control @error('rejection_reason') is-invalid @enderror"
                            rows="4"
                            placeholder="Jelaskan alasan penolakan kepada nailist..."
                            required
                        >{{ old('rejection_reason') }}</textarea>
                        @error('rejection_reason')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Alasan ini akan dikirim ke nailist via email.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times-circle"></i> Reject
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.avatar-circle-large {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    font-weight: bold;
}

.badge-lg {
    font-size: 14px;
    padding: 8px 16px;
}

.border-left-primary {
    border-left: 4px solid #4e73df;
}
</style>
@endsection
