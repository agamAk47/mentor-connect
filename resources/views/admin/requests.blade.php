@extends('layouts.admin')
@section('title', 'Mentorship Requests | MentorConnect')
@section('page_title', 'Requests')

@section('content')
<div class="flex flex-wrap gap-2 mb-6">
    @foreach(['' => 'All', 'pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'] as $val => $label)
        <a href="{{ route('admin.requests', $val ? ['status' => $val] : []) }}"
           class="px-4 py-2 rounded-xl text-sm font-semibold {{ request('status', '') === $val ? 'bg-teal-600 text-white' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
            {{ $label }}
        </a>
    @endforeach
</div>

<div class="space-y-4">
    @forelse($requests as $req)
        <div class="bg-white rounded-2xl border border-slate-200 p-6">
            <div class="flex flex-wrap items-start justify-between gap-4 mb-3">
                <div>
                    <p class="font-bold text-slate-900">{{ $req->startup->startup_name ?? 'Startup' }} → {{ $req->mentor->name ?? 'Mentor' }}</p>
                    <p class="text-xs text-slate-500 mt-1">{{ $req->created_at?->format('M d, Y H:i') ?? '' }}</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-semibold
                    {{ $req->status === 'approved' ? 'bg-teal-100 text-teal-700' : ($req->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">
                    {{ ucfirst($req->status) }}
                </span>
            </div>
            <p class="text-sm text-slate-600 bg-slate-50 rounded-xl p-4 border-l-4 border-teal-500">{{ $req->message }}</p>
        </div>
    @empty
        <p class="text-center text-slate-500 py-12">No requests found.</p>
    @endforelse
</div>
{{ $requests->links() }}
@endsection
