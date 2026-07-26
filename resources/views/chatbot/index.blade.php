@extends('layouts.dashboard')
@section('title', 'Assistant — Medicare')
@section('page-title', 'Assistant santé')

@section('sidebar')
    @php
        $partiel = match(auth()->user()->role) {
            'patient' => 'partials.sidebar-patient',
            'medecin' => 'partials.sidebar-medecin',
            'admin', 'superadmin' => 'partials.sidebar-admin',
            default => 'partials.sidebar-patient',
        };
    @endphp
    @include($partiel, ['active' => 'assistant'])
@endsection

@section('content')

<div x-data="chatbot()" x-init="init()" class="flex flex-col h-[calc(100vh-8rem)] md:h-[calc(100vh-9rem)]">

    <div class="mb-4">
        <h2 class="text-[18px] font-semibold text-slate-900">Assistant santé</h2>
        <p class="text-slate-500 text-[13px] mt-0.5">Pose tes questions — je ne remplace pas un avis médical professionnel.</p>
    </div>

    <div class="flex-1 bg-white rounded-2xl border border-slate-200 flex flex-col overflow-hidden">

        <div class="flex-1 overflow-y-auto px-4 py-4 space-y-3" x-ref="messagesContainer">

            <template x-if="messages.length === 0">
                <div class="h-full flex flex-col items-center justify-center text-center px-6">
                    <div class="w-14 h-14 rounded-full bg-teal-50 flex items-center justify-center mb-3">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.75" class="text-teal-600"><path d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM21 12c0 4.556-4.03 8.25-9 8.25a9.76 9.76 0 01-2.555-.337 5.97 5.97 0 01-3.035.612 4.48 4.48 0 00.978-2.025C4.07 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"/></svg>
                    </div>
                    <p class="text-[13.5px] font-medium text-slate-700">Comment puis-je t'aider aujourd'hui ?</p>
                    <p class="text-[12px] text-slate-400 mt-1">Symptômes, conseils de santé, ou orientation vers un médecin.</p>
                </div>
            </template>

            <template x-for="msg in messages" :key="msg.id">
                <div class="flex" :class="msg.role === 'user' ? 'justify-end' : 'justify-start'">
                    <div class="max-w-[80%] md:max-w-[65%] px-4 py-2.5 rounded-2xl text-[13px] leading-relaxed"
                         :class="msg.role === 'user' ? 'bg-teal-600 text-white rounded-br-sm' : 'bg-slate-100 text-slate-800 rounded-bl-sm'"
                         x-text="msg.contenu">
                    </div>
                </div>
            </template>

            <template x-if="loading">
                <div class="flex justify-start">
                    <div class="bg-slate-100 px-4 py-2.5 rounded-2xl rounded-bl-sm flex gap-1 items-center">
                        <span class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 0ms"></span>
                        <span class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 150ms"></span>
                        <span class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 300ms"></span>
                    </div>
                </div>
            </template>

        </div>

        <form @submit.prevent="envoyer()" class="border-t border-slate-100 p-3 flex gap-2 items-end shrink-0">
            <textarea x-model="nouveauMessage"
                      @keydown.enter.prevent="if (!$event.shiftKey) envoyer()"
                      rows="1"
                      placeholder="Écris ton message..."
                      class="flex-1 resize-none rounded-xl border border-slate-200 px-3.5 py-2.5 text-[13px] focus:outline-none focus:ring-2 focus:ring-teal-500/30 focus:border-teal-500 max-h-32"></textarea>
            <button type="submit" :disabled="loading || !nouveauMessage.trim()"
                    class="w-10 h-10 shrink-0 bg-teal-600 hover:bg-teal-700 disabled:opacity-40 disabled:hover:bg-teal-600 rounded-xl flex items-center justify-center transition">
                <svg width="16" height="16" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10l14-7-7 14-2-5-5-2z"/></svg>
            </button>
        </form>

    </div>
</div>

@endsection

@push('scripts')
<script>
function chatbot() {
    return {
        messages: @json($messages->map(fn($m) => ['id' => $m->id, 'role' => $m->role, 'contenu' => $m->contenu])),
        nouveauMessage: '',
        loading: false,

        init() {
            this.scrollToBottom();
        },

        scrollToBottom() {
            this.$nextTick(() => {
                const c = this.$refs.messagesContainer;
                c.scrollTop = c.scrollHeight;
            });
        },

        envoyer() {
            const texte = this.nouveauMessage.trim();
            if (!texte || this.loading) return;

            this.messages.push({ id: Date.now(), role: 'user', contenu: texte });
            this.nouveauMessage = '';
            this.loading = true;
            this.scrollToBottom();

            fetch('{{ route('chatbot.envoyer') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                },
                body: JSON.stringify({ message: texte }),
            })
            .then(r => r.json())
            .then(data => {
                this.messages.push({ id: Date.now() + 1, role: 'assistant', contenu: data.reponse });
                this.loading = false;
                this.scrollToBottom();
            })
            .catch(() => {
                this.messages.push({ id: Date.now() + 1, role: 'assistant', contenu: "Désolé, une erreur est survenue. Réessaie." });
                this.loading = false;
                this.scrollToBottom();
            });
        }
    }
}
</script>
@endpush
