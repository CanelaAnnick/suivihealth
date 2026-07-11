@extends('layouts.dashboard')
@section('title', 'Statistiques — SuiviHealth')
@section('page-title', 'Statistiques')

@section('sidebar')
    @include('partials.sidebar-admin', ['active' => 'stats'])
@endsection

@section('content')

<div class="grid md:grid-cols-2 gap-5">
    <div class="bg-white border border-slate-200 rounded-2xl p-5">
        <h3 class="text-[13.5px] font-semibold text-slate-900 mb-4">Consultations par semaine (8 dernières semaines)</h3>
        <canvas id="semaineChart" height="180"></canvas>
    </div>
    <div class="bg-white border border-slate-200 rounded-2xl p-5">
        <h3 class="text-[13.5px] font-semibold text-slate-900 mb-4">Répartition par spécialité</h3>
        <canvas id="specialiteChart" height="180"></canvas>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script>
    const semaineData = @json($consultationsParSemaine);
    new Chart(document.getElementById('semaineChart'), {
        type: 'line',
        data: {
            labels: semaineData.map(d => d.label),
            datasets: [{ label: 'Consultations', data: semaineData.map(d => d.count), borderColor: '#0B3A66', backgroundColor: 'rgba(11,58,102,0.08)', fill: true, tension: 0.35 }]
        },
        options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
    });

    const specData = @json($parSpecialite);
    new Chart(document.getElementById('specialiteChart'), {
        type: 'bar',
        data: {
            labels: specData.map(d => d.specialite),
            datasets: [{ label: 'Consultations', data: specData.map(d => d.total), backgroundColor: '#1E9E6B', borderRadius: 6 }]
        },
        options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
    });
</script>
@endpush