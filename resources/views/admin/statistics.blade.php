@extends('layouts.admin')
@section('title', 'Statistics | MentorConnect')
@section('page_title', 'Platform Statistics')

@section('content')
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    @foreach($chartData['totals'] as $label => $value)
        <div class="bg-white rounded-2xl border border-slate-200 p-6 text-center">
            <p class="text-3xl font-black text-teal-600">{{ $value }}</p>
            <p class="text-sm text-slate-500 mt-1 capitalize">{{ $label }}</p>
        </div>
    @endforeach
</div>

<div class="grid lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-2xl border border-slate-200 p-6">
        <h3 class="font-bold text-slate-900 mb-4">Mentor Status Distribution</h3>
        <canvas id="mentorStatusChart" height="200"></canvas>
    </div>
    <div class="bg-white rounded-2xl border border-slate-200 p-6">
        <h3 class="font-bold text-slate-900 mb-4">Requests by Status</h3>
        <canvas id="requestStatusChart" height="200"></canvas>
    </div>
    <div class="bg-white rounded-2xl border border-slate-200 p-6 lg:col-span-2">
        <h3 class="font-bold text-slate-900 mb-4">Top Categories by Mentor Count</h3>
        <canvas id="categoryChart" height="120"></canvas>
    </div>
    <div class="bg-white rounded-2xl border border-slate-200 p-6 lg:col-span-2">
        <h3 class="font-bold text-slate-900 mb-4">Mentor Registrations (Last 6 Months)</h3>
        <canvas id="trendChart" height="120"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const chartData = @json($chartData);

new Chart(document.getElementById('mentorStatusChart'), {
    type: 'doughnut',
    data: {
        labels: ['Pending', 'Approved', 'Rejected'],
        datasets: [{ data: [chartData.mentorStatus.pending, chartData.mentorStatus.approved, chartData.mentorStatus.rejected], backgroundColor: ['#F59E0B', '#0D9488', '#EF4444'] }]
    }
});

new Chart(document.getElementById('requestStatusChart'), {
    type: 'bar',
    data: {
        labels: ['Pending', 'Approved', 'Rejected'],
        datasets: [{ label: 'Requests', data: [chartData.requestStatus.pending, chartData.requestStatus.approved, chartData.requestStatus.rejected], backgroundColor: '#6366F1' }]
    },
    options: { scales: { y: { beginAtZero: true } } }
});

new Chart(document.getElementById('categoryChart'), {
    type: 'bar',
    data: {
        labels: Object.keys(chartData.topCategories),
        datasets: [{ label: 'Mentors', data: Object.values(chartData.topCategories), backgroundColor: '#0D9488' }]
    },
    options: { indexAxis: 'y', scales: { x: { beginAtZero: true } } }
});

new Chart(document.getElementById('trendChart'), {
    type: 'bar',
    data: {
        labels: chartData.mentorTrendLabels,
        datasets: [{ label: 'New Mentors', data: chartData.mentorTrend, backgroundColor: '#14B8A6' }]
    },
    options: { scales: { y: { beginAtZero: true } } }
});
</script>
@endsection
