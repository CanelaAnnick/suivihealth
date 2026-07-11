@extends('layouts.dashboard')
@section('title', 'Salle de consultation — SuiviHealth')
@section('page-title', 'Consultation en cours')

@section('sidebar')
    @include('partials.sidebar-'.auth()->user()->role, ['active' => ''])
@endsection

@section('content')

@php
    $autre = auth()->user()->role === 'patient' ? $rdv->medecin->user->name : $rdv->patient->user->name;
@endphp

<div class="bg-white border border-slate-200 rounded-2xl p-4 mb-4 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-navy-900 text-white flex items-center justify-center text-[12px] font-semibold">
            {{ strtoupper(substr($autre, 0, 2)) }}
        </div>
        <div>
            <p class="text-[13.5px] font-semibold text-slate-900">{{ $autre }}</p>
            <p class="text-[12px] text-slate-500">{{ ucfirst($rdv->mode) }} · {{ $rdv->type === 'immediat' ? 'Consultation immédiate' : \Carbon\Carbon::parse($rdv->date_rdv)->format('d/m/Y').' à '.\Carbon\Carbon::parse($rdv->heure_rdv)->format('H:i') }}</p>
        </div>
    </div>
    <span class="text-[11px] font-medium px-2.5 py-1 rounded-full bg-teal-50 text-teal-700">En cours</span>
</div>

@if (in_array($rdv->mode, ['audio', 'video']))
    <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center" x-data="{ joined: false }">
        <div class="w-16 h-16 mx-auto rounded-full bg-navy-900/5 flex items-center justify-center text-navy-800 mb-5">
            @if ($rdv->mode === 'video')
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"/></svg>
            @else
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 002.25-2.25v-1.5a1.125 1.125 0 00-.852-1.09l-4.5-1.125a1.125 1.125 0 00-1.173.417l-.97 1.293a12.05 12.05 0 01-5.649-5.649l1.293-.97a1.125 1.125 0 00.417-1.173L8.09 3.102a1.125 1.125 0 00-1.09-.852h-1.5A2.25 2.25 0 003.25 4.5"/></svg>
            @endif
        </div>
        <h3 class="text-[15px] font-semibold text-slate-900 mb-1.5">Salle {{ $rdv->mode === 'video' ? 'vidéo' : 'audio' }} prête</h3>
        <p class="text-slate-500 text-[13px] mb-6 max-w-sm mx-auto">La salle s'ouvre dans un nouvel onglet pour garantir une connexion caméra/micro fiable.</p>

        <a href="https://meet.jit.si/suivihealth-{{ $rdv->salle_id }}#config.startWithVideoMuted={{ $rdv->mode === 'audio' ? 'true' : 'false' }}&userInfo.displayName=%22{{ urlencode(auth()->user()->name) }}%22"
            target="_blank" @click="joined = true"
            class="inline-flex items-center gap-2 bg-navy-900 text-white text-[13.5px] font-medium px-6 py-3 rounded-lg hover:bg-navy-800 transition">
            Ouvrir la salle {{ $rdv->mode === 'video' ? 'vidéo' : 'audio' }}
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 3h6v6M12 3L7 8M9 3H3.75A.75.75 0 003 3.75V12a.75.75 0 00.75.75H12a.75.75 0 00.75-.75V9"/></svg>
        </a>

        <p x-show="joined" x-cloak class="text-[12px] text-teal-600 mt-4">Onglet ouvert — l'autre participant doit aussi cliquer sur ce bouton pour vous rejoindre.</p>
        <p class="text-[11.5px] text-slate-400 mt-5">Assurez-vous d'autoriser la caméra et le micro quand le navigateur le demande.</p>
    </div>
@else
    <div class="bg-white border border-slate-200 rounded-2xl flex flex-col" style="height: 560px;" x-data="chatSalle({{ $rdv->id }}, {{ auth()->id() }})" x-init="load(); setInterval(load, 3000)">
        <div class="flex-1 overflow-y-auto p-4 space-y-3" id="chat-scroll" x-ref="scroll">
            <template x-for="m in messages" :key="m.id">
                <div :class="m.sender_id === userId ? 'flex justify-end' : 'flex justify-start'">
                    <div :class="m.sender_id === userId ? 'bg-navy-900 text-white' : 'bg-slate-100 text-slate-900'" class="max-w-[75%] rounded-2xl px-3.5 py-2 text-[13px]">
                        <p x-text="m.contenu"></p>
                        <p :class="m.sender_id === userId ? 'text-white/60' : 'text-slate-400'" class="text-[10.5px] mt-1" x-text="new Date(m.created_at).toLocaleTimeString('fr-FR', {hour:'2-digit', minute:'2-digit'})"></p>
                    </div>
                </div>
            </template>
            <template x-if="messages.length === 0">
                <p class="text-center text-[13px] text-slate-400 py-10">Aucun message pour le moment. Démarrez la conversation.</p>
            </template>
        </div>
        <form @submit.prevent="envoyer()" class="border-t border-slate-100 p-3 flex gap-2">
            <input type="text" x-model="texte" placeholder="Écrire un message..." class="flex-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
            <button type="submit" class="bg-navy-900 text-white px-4 rounded-lg hover:bg-navy-800 transition">
                <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 15l14-6-14-6v5l9 1-9 1v5z"/></svg>
            </button>
        </form>
    </div>

    @push('scripts')
    <script>
        function chatSalle(rdvId, userId) {
            return {
                messages: [], texte: '', userId: userId,
                csrf() { return document.querySelector('meta[name="csrf-token"]').content },
                async load() {
                    const res = await fetch(`/salle/${rdvId}/messages`);
                    this.messages = await res.json();
                    this.$nextTick(() => { this.$refs.scroll.scrollTop = this.$refs.scroll.scrollHeight });
                },
                async envoyer() {
                    if (!this.texte.trim()) return;
                    const res = await fetch(`/salle/${rdvId}/messages`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': this.csrf() },
                        body: JSON.stringify({ contenu: this.texte }),
                    });
                    const msg = await res.json();
                    this.messages.push(msg);
                    this.texte = '';
                    this.$nextTick(() => { this.$refs.scroll.scrollTop = this.$refs.scroll.scrollHeight });
                },
            }
        }
    </script>
    @endpush
@endif

@endsection