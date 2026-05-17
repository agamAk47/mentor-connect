@extends('layouts.admin')
@section('title', 'Manage Startups | MentorConnect')
@section('page_title', 'Startups')

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-600">
            <tr>
                <th class="text-left p-4">Startup</th>
                <th class="text-left p-4">Founder</th>
                <th class="text-left p-4">Email</th>
                <th class="text-left p-4">Industry</th>
                <th class="text-left p-4">Stage</th>
                <th class="text-left p-4">Requests</th>
                <th class="text-left p-4">Registered</th>
                <th class="text-left p-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($startups as $startup)
                @php
                    $stage = strtolower($startup->stage ?? '');
                    $stageClass = match(true) {
                        str_contains($stage, 'idea') => 'bg-blue-100 text-blue-700',
                        str_contains($stage, 'mvp') => 'bg-purple-100 text-purple-700',
                        str_contains($stage, 'growth') => 'bg-teal-100 text-teal-700',
                        str_contains($stage, 'scale') => 'bg-orange-100 text-orange-700',
                        default => 'bg-slate-100 text-slate-700',
                    };
                @endphp
                <tr class="border-t border-slate-100">
                    <td class="p-4 font-medium">{{ $startup->startup_name }}</td>
                    <td class="p-4">{{ $startup->founder_name }}</td>
                    <td class="p-4 text-slate-600">{{ $startup->email }}</td>
                    <td class="p-4">{{ $startup->industry ?? '—' }}</td>
                    <td class="p-4"><span class="px-2 py-1 rounded-full text-xs font-semibold {{ $stageClass }}">{{ $startup->stage ?? '—' }}</span></td>
                    <td class="p-4">{{ $countsMap[(string)$startup->id] ?? 0 }}</td>
                    <td class="p-4 text-slate-500">{{ $startup->created_at?->format('M d, Y') ?? '—' }}</td>
                    <td class="p-4">
                        <form action="{{ route('admin.startups.delete', $startup->id) }}" method="POST" onsubmit="return confirm('Delete this startup and all their data?')">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1 border border-red-200 text-red-600 rounded-lg text-xs font-semibold hover:bg-red-50">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $startups->links() }}
@endsection
