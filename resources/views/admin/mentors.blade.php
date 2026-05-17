@extends('layouts.admin')
@section('title', 'Manage Mentors | MentorConnect')
@section('page_title', 'Mentors')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row gap-4 justify-between">
    <input type="text" id="searchMentors" placeholder="Search by name or email..."
        class="px-4 py-2 border border-slate-200 rounded-xl text-sm w-full sm:w-80 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500">
    <label class="flex items-center gap-2 text-sm text-slate-500"><input type="checkbox" disabled class="rounded"> Select All (coming soon)</label>
</div>

<div class="bg-white rounded-2xl border border-slate-200 overflow-x-auto">
    <table class="w-full text-sm" id="mentorsTable">
        <thead class="bg-slate-50 text-slate-600">
            <tr>
                <th class="text-left p-4">Name</th>
                <th class="text-left p-4">Email</th>
                <th class="text-left p-4">Category</th>
                <th class="text-left p-4">Experience</th>
                <th class="text-left p-4">Bio</th>
                <th class="text-left p-4">Status</th>
                <th class="text-left p-4">Registered</th>
                <th class="text-left p-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mentors as $mentor)
                <tr class="border-t border-slate-100 mentor-row">
                    <td class="p-4 font-medium text-slate-900 mentor-name">{{ $mentor->name }}</td>
                    <td class="p-4 text-slate-600 mentor-email">{{ $mentor->email }}</td>
                    <td class="p-4">{{ $mentor->category->name ?? '—' }}</td>
                    <td class="p-4">{{ $mentor->experience }} yrs</td>
                    <td class="p-4 max-w-xs truncate text-slate-500">{{ \Illuminate\Support\Str::limit($mentor->bio ?? '', 60) }}</td>
                    <td class="p-4">
                        @php $st = $mentor->status ?? 'pending'; @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            {{ $st === 'approved' ? 'bg-teal-100 text-teal-700' : ($st === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">
                            {{ ucfirst($st) }}
                        </span>
                    </td>
                    <td class="p-4 text-slate-500">{{ $mentor->created_at?->format('M d, Y') ?? '—' }}</td>
                    <td class="p-4">
                        <div class="flex flex-wrap gap-2">
                            @if(($mentor->status ?? 'pending') !== 'approved')
                                <form action="{{ route('admin.mentors.approve', $mentor->id) }}" method="POST">@csrf @method('PATCH')
                                    <button class="px-3 py-1 bg-teal-600 text-white rounded-lg text-xs font-semibold hover:bg-teal-700">Approve</button>
                                </form>
                            @endif
                            @if(($mentor->status ?? 'pending') !== 'rejected')
                                <form action="{{ route('admin.mentors.reject', $mentor->id) }}" method="POST">@csrf @method('PATCH')
                                    <button class="px-3 py-1 bg-red-600 text-white rounded-lg text-xs font-semibold hover:bg-red-700">Reject</button>
                                </form>
                            @endif
                            <form action="{{ route('admin.mentors.delete', $mentor->id) }}" method="POST" onsubmit="return confirm('Delete this mentor and all their data?')">@csrf @method('DELETE')
                                <button class="px-3 py-1 border border-red-200 text-red-600 rounded-lg text-xs font-semibold hover:bg-red-50">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $mentors->links() }}
@endsection

@section('scripts')
<script>
document.getElementById('searchMentors')?.addEventListener('input', function(e) {
    const q = e.target.value.toLowerCase();
    document.querySelectorAll('.mentor-row').forEach(row => {
        const name = row.querySelector('.mentor-name')?.textContent.toLowerCase() || '';
        const email = row.querySelector('.mentor-email')?.textContent.toLowerCase() || '';
        row.style.display = (name.includes(q) || email.includes(q)) ? '' : 'none';
    });
});
lucide.createIcons();
</script>
@endsection
