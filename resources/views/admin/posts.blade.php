@extends('layouts.admin')
@section('title', 'Moderate Posts | MentorConnect')
@section('page_title', 'Community Posts')

@section('content')
<div class="flex flex-wrap gap-2 mb-6">
    <a href="{{ route('admin.posts') }}" class="px-4 py-2 rounded-xl text-sm font-semibold {{ !request('role') ? 'bg-teal-600 text-white' : 'bg-white border border-slate-200' }}">All</a>
    <a href="{{ route('admin.posts', ['role' => 'mentor']) }}" class="px-4 py-2 rounded-xl text-sm font-semibold {{ request('role') === 'mentor' ? 'bg-teal-600 text-white' : 'bg-white border border-slate-200' }}">Mentor Posts</a>
    <a href="{{ route('admin.posts', ['role' => 'startup']) }}" class="px-4 py-2 rounded-xl text-sm font-semibold {{ request('role') === 'startup' ? 'bg-teal-600 text-white' : 'bg-white border border-slate-200' }}">Startup Posts</a>
</div>

<div class="grid md:grid-cols-2 gap-4">
    @forelse($posts as $post)
        <div class="bg-white rounded-2xl border border-slate-200 p-6">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-slate-900">{{ $post->author_name }}</span>
                    <span class="text-xs px-2 py-0.5 rounded-full font-semibold {{ ($post->author_role ?? '') === 'mentor' ? 'bg-teal-100 text-teal-700' : 'bg-indigo-100 text-indigo-700' }}">
                        {{ ucfirst($post->author_role ?? 'user') }}
                    </span>
                </div>
                <span class="text-xs text-slate-500">{{ $post->created_at ?? '' }}</span>
            </div>
            <p class="text-sm text-slate-600 mb-4">{{ \Illuminate\Support\Str::limit($post->content, 200) }}</p>
            <form action="{{ route('admin.posts.delete', (string) $post->id) }}" method="POST" onsubmit="return confirm('Delete this post?')">
                @csrf @method('DELETE')
                <button class="px-4 py-2 bg-red-600 text-white rounded-xl text-xs font-semibold hover:bg-red-700">Delete</button>
            </form>
        </div>
    @empty
        <p class="col-span-2 text-center text-slate-500 py-12">No posts found.</p>
    @endforelse
</div>
{{ $posts->links() }}
@endsection
