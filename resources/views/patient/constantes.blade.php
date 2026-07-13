@extends('layouts.dashboard')
@section('title', 'Mes constantes — SuiviHealth')
@section('page-title', 'Mes constantes')

@section('sidebar')
    @include('partials.sidebar-patient', ['active' => 'constantes'])
@endsection

@section('content')

@if (session('status'))
    <div class="mb-5 text-[13px] text-teal-700 bg-teal-50 px-3.5 py-2 rounded-lg inline-block">{{ session('status') }}</div>
@endif

<div class="grid md:grid-cols-5 gap-5 mb-6">
    <form method="POST" action="{{ route('patient.constantes.store') }}" x-data="{ type: 'poids' }" class="md:col-span-2 bg-white border border-slate-200 rounded-xl p-5 space-y-4 h-fit">
        @csrf
        <h2 class="text-[13.5px] font-semibold text-slate-900">Ajouter une mesure</h2>

        <div>
            <label class="text-[12.5px] font-medium text-slate-700 block mb-1.5">Type</label>
            <select name="type" x-model="type" class="w-full rounded-md border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                <option value="poids">Poids (kg)</option>
                <option value="tension">Tension artérielle (mmHg)</option>
                <option value="glycemie">Glycémie (g/L)</option>
                <option value="temperature">Température (°C)</option>
            </select>
        </div>

        <div>
            <label class="text-[12.5px] font-medium text-slate-700" x-text="type === 'tension' ? 'Systolique' : 'Valeur'"></label>
            <input type="number" step="0.1" name="valeur" required class="w-full mt-1 rounded-md border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
            @error('valeur') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
        </div>

        <div x-show="type === 'tension'" x-cloak>
            <label class="text-[12.5px] font-medium text-slate-700">Diastolique</label>
            <input type="number" step="0.1" name="valeur_secondaire" class="w-full mt-1 rounded-md border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
        </div>

        <button type="submit" class="w-full bg-navy-900 text-white text-[13px] font-medium py-2.5 rounded-md hover:bg-navy-800 transition">Enregistrer</button>
    </form>

    <div class="md:col-span-3 bg-white border border-slate-200 rounded-xl p-5">
        <h2 class="text-[13.5px] font-semibold text-slate-900 mb-4">Évolution du poids</h2>
        <canvas id="poidsChart" height="140"></canvas>
    </div>
</div>

<div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
    <div class="px-5 py-3.5 border-b border-slate-100">
        <h2 class="text-[13.5px] font-semibold text-slate-900">Historique complet</h2>
    </div>
    @forelse ($constantes as $c)
    <div class="flex items-center justify-between px-5 py-3 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
        <div>
            <p class="text-[13px] font-medium text-slate-900">
                {{ ucfirst($c->type) }} —
                @if ($c->type === 'tension') {{ $c->valeur }}/{{ $c->valeur_secondaire }} mmHg
                @else {{ $c->valeur }} {{ $c->type === 'poids' ? 'kg' : ($c->type === 'glycemie' ? 'g/L' : '°C') }}
                @endif
            </p>
            <p class="text-[12px] text-slate-400 mt-0.5">{{ $c->created_at->format('d/m/Y à H:i') }}</p>
        </div>
        <form method="POST" action="{{ route('patient.constantes.destroy', $c) }}" onsubmit="return confirm('Supprimer cette mesure ?')">
            @csrf @method('delete')
            <button type="submit" class="text-[11.5px] text-red-600 font-medium hover:underline">Supprimer</button>
        </form>
    </div>
    @empty
        <div class="px-5 py-8 text-center">
            <p class="text-[13px] text-slate-400">Aucune constante enregistrée pour le moment.</p>
        </div>
    @endforelse
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script>
    const poidsData = @json($poids->map(fn($p) => ['x' => $p->created_at->format('d/m'), 'y' => $p->valeur]));
    new Chart(document.getElementById('poidsChart'), {
        type: 'line',
        data: {
            labels: poidsData.map(p => p.x),
            datasets: [{
                label: 'Poids (kg)',
                data: poidsData.map(p => p.y),
                borderColor: '#1E9E6B',
                backgroundColor: 'rgba(30,158,107,0.08)',
                fill: true,
                tension: 0.35,
            }]
        },
        options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: false } } }
    });
</script>
@endpush