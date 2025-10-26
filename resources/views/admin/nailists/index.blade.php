@extends('admin.layout')

@section('title', 'Manajemen Nailist')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Nailist</h1>
    </div>

    @if($nailists->count())
    <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Nailist</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Kontak</th>
                    <th class="text-center py-3 px-4 font-semibold text-gray-700">Katalog</th>
                    <th class="text-center py-3 px-4 font-semibold text-gray-700">Status</th>
                    <th class="text-center py-3 px-4 font-semibold text-gray-700">Terdaftar</th>
                    <th class="text-center py-3 px-4 font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nailists as $nailist)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-4 text-gray-700">
                            <div class="flex items-center gap-2">
                                <div class="avatar-circle-small" style="width:32px;height:32px;font-size:1rem;">{{ substr($nailist->name, 0, 1) }}</div>
                                <div>
                                    <span class="font-bold">{{ $nailist->salon_name }}</span>
                                    <div class="text-xs text-gray-500">{{ $nailist->name }}</div>
                                    @if($nailist->address)
                                        <div class="text-xs text-gray-400"><i class="fas fa-map-marker-alt"></i> {{ $nailist->address }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-gray-700">
                            <div class="flex flex-col gap-1">
                                <span><i class="fas fa-phone-alt mr-1"></i>{{ $nailist->phone }}</span>
                                @if($nailist->whatsapp)
                                    <span><i class="fab fa-whatsapp mr-1"></i>{{ $nailist->whatsapp }}</span>
                                @endif
                                @if($nailist->instagram)
                                    <span><i class="fab fa-instagram mr-1"></i>{{ $nailist->instagram }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="py-3 px-4 text-center text-gray-700">
                            <span class="font-semibold">{{ $nailist->catalog_count }}</span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if($nailist->is_nailist_approved === null)
                                <span class="badge-warning">Pending</span>
                            @elseif($nailist->is_nailist_approved)
                                <span class="badge-success">Approved</span>
                            @else
                                <span class="badge-danger">Rejected</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center text-gray-700 text-sm">
                            <span>{{ $nailist->created_at->format('d M Y') }}</span><br>
                            <span class="text-xs text-gray-400">{{ $nailist->created_at->diffForHumans() }}</span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <a href="{{ route('admin.nailists.show', $nailist->id) }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">Review</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $nailists->appends(['status' => $status])->links() }}
            </div>
            @else
            <!-- Empty State -->
            <div class="text-center py-5">
                <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Tidak Ada Nailist</h5>
                <p class="text-muted">
                    @if($status === 'pending')
                        Tidak ada nailist yang menunggu persetujuan.
                    @elseif($status === 'approved')
                        Belum ada nailist yang di-approve.
                    @elseif($status === 'rejected')
                        Tidak ada nailist yang ditolak.
                    @else
                        Belum ada nailist terdaftar di sistem.
                    @endif
                </p>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.avatar-circle {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    font-weight: bold;
}

.nav-tabs .nav-link {
    color: #6c757d;
}

.nav-tabs .nav-link.active {
    color: #4e73df;
    border-bottom: 2px solid #4e73df;
}

.nav-tabs .nav-link:hover {
    border-color: transparent;
}

.table td {
    vertical-align: middle;
}
</style>
@endsection
