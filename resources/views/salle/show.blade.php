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
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden" style="height: 560px;">
        <div id="jitsi-container" class="w-full h-full"></div>
    </div>

    @push('scripts')
    <script src="https://meet.jit.si/external_api.js"></script>
    <script>
        new JitsiMeetExternalAPI("meet.jit.si", {
            roomName: "suivihealth-{{ $rdv->salle_id }}",
            parentNode: document.querySelector('#jitsi-container'),
            userInfo: { displayName: "{{ auth()->user()->name }}" },
            configOverwrite: {
                startWithVideoMuted: {{ $rdv->mode === 'audio' ? 'true' : 'false' }},
                prejoinPageEnabled: false,
            },
            interfaceConfigOverwrite: {
                TOOLBAR_BUTTONS: {{ $rdv->mode === 'audio'
                    ? "['microphone', 'hangup', 'chat']"
                    : "['microphone', 'camera', 'hangup', 'chat', 'tileview']" }},
            },
        });
    </script>
    @endpush
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