<?php
use Illuminate\Support\Facades\DB;
use App\Models\Mentor;

$mentor = Mentor::first();
if ($mentor) {
    DB::table('posts')->where('author_role', 'mentor')->update(['author_id' => $mentor->id]);
    echo "Updated mentor posts with real ID: " . $mentor->id . "\n";
} else {
    echo "No mentors found to update posts.\n";
}
