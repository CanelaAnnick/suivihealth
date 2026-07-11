<div x-data="consultationModal()" @open-consultation.window="open($event.detail)" x-show="visible" x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/50" @click="close()"></div>
    <div class="relative bg-white rounded-2xl w-full max-w-md max-h-[90vh] overflow-y-auto shadow-xl">

        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <div>
                <h3 class="text-[14px] font-semibold text-slate-900" x-text="step==='success' ? 'Confirmation' : (flow==='rdv' ? 'Prendre rendez-vous' : 'Consultation')"></h3>
                <p class="text-[12px] text-slate-500 mt-0.5" x-text="nom + ' — ' + specialite"></p>
            </div>
            <button @click="close()" class="text-slate-400 hover:text-slate-700">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4l10 10M14 4L4 14"/></svg>
            </button>
        </div>

        <div class="p-5">

            <template x-if="step === 'mode'">
                <div>
                    <p class="text-[13px] font-medium text-slate-900 mb-3">Comment souhaitez-vous consulter ?</p>
                    <div class="grid grid-cols-3 gap-2.5 mb-5">
                        <button type="button" @click="mode='chat'" :class="mode==='chat' ? 'border-navy-800 bg-navy-900/5' : 'border-slate-200'" class="border rounded-xl p-3.5 text-center hover:border-navy-800 transition">
                            <svg width="18" height="18" class="mx-auto mb-1.5 text-slate-600" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                            <span class="text-[11.5px] font-medium text-slate-900">Chat</span>
                        </button>
                        <button type="button" @click="mode='audio'" :class="mode==='audio' ? 'border-navy-800 bg-navy-900/5' : 'border-slate-200'" class="border rounded-xl p-3.5 text-center hover:border-navy-800 transition">
                            <svg width="18" height="18" class="mx-auto mb-1.5 text-slate-600" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 002.25-2.25v-1.5a1.125 1.125 0 00-.852-1.09l-4.5-1.125a1.125 1.125 0 00-1.173.417l-.97 1.293a12.05 12.05 0 01-5.649-5.649l1.293-.97a1.125 1.125 0 00.417-1.173L8.09 3.102a1.125 1.125 0 00-1.09-.852h-1.5A2.25 2.25 0 003.25 4.5"/></svg>
                            <span class="text-[11.5px] font-medium text-slate-900">Audio</span>
                        </button>
                        <button type="button" @click="mode='video'" :class="mode==='video' ? 'border-navy-800 bg-navy-900/5' : 'border-slate-200'" class="border rounded-xl p-3.5 text-center hover:border-navy-800 transition">
                            <svg width="18" height="18" class="mx-auto mb-1.5 text-slate-600" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"/></svg>
                            <span class="text-[11.5px] font-medium text-slate-900">Vidéo</span>
                        </button>
                    </div>
                    <button type="button" @click="next()" :disabled="!mode" :class="mode ? '' : 'opacity-40 cursor-not-allowed'" class="w-full bg-navy-900 text-white text-[13px] font-medium py-2.5 rounded-lg hover:bg-navy-800 transition">
                        Continuer
                    </button>
                </div>
            </template>

            <template x-if="step === 'date'">
                <div>
                    <p class="text-[13px] font-medium text-slate-900 mb-2">Choisir une date</p>
                    <input type="date" x-model="date" :min="today" class="w-full rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800 mb-4">

                    <p class="text-[13px] font-medium text-slate-900 mb-2">Choisir un créneau horaire</p>
                    <div class="grid grid-cols-4 gap-2 mb-5">
                        <template x-for="h in creneaux" :key="h">
                            <button type="button" @click="heure = h" :class="heure === h ? 'bg-navy-900 text-white border-navy-900' : 'border-slate-200 text-slate-700'" class="border rounded-lg py-2 text-[12px] font-medium hover:border-navy-800 transition" x-text="h"></button>
                        </template>
                    </div>

                    <div class="flex gap-2.5">
                        <button type="button" @click="step='mode'" class="flex-1 border border-slate-200 text-slate-700 text-[13px] font-medium py-2.5 rounded-lg hover:bg-slate-50 transition">Retour</button>
                        <button type="button" @click="next()" :disabled="!date || !heure" :class="(date && heure) ? '' : 'opacity-40 cursor-not-allowed'" class="flex-1 bg-navy-900 text-white text-[13px] font-medium py-2.5 rounded-lg hover:bg-navy-800 transition">Continuer</button>
                    </div>
                </div>
            </template>

            <template x-if="step === 'paiement'">
                <div>
                    <div class="bg-mist rounded-xl p-4 mb-5">
                        <div class="flex justify-between text-[13px] mb-1.5"><span class="text-slate-500">Médecin</span><span class="font-medium text-slate-900" x-text="nom"></span></div>
                        <div class="flex justify-between text-[13px] mb-1.5" x-show="date"><span class="text-slate-500">Date & heure</span><span class="font-medium text-slate-900" x-text="date + ' à ' + heure"></span></div>
                        <div class="flex justify-between text-[14px] pt-2 mt-2 border-t border-slate-200"><span class="font-semibold text-slate-900">Total</span><span class="font-semibold text-navy-900" x-text="tarif.toLocaleString('fr-FR') + ' FCFA'"></span></div>
                    </div>

                    <p class="text-[13px] font-medium text-slate-900 mb-3">Mode de paiement</p>
                    <div class="space-y-2.5 mb-5">
                        <label class="flex items-center gap-3 border rounded-xl p-3.5 cursor-pointer" :class="paiement === 'orange_money' ? 'border-navy-800 bg-navy-900/5' : 'border-slate-200'">
                            <input type="radio" x-model="paiement" value="orange_money" class="accent-navy-900">
                            <span class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-[10.5px]">OM</span>
                            <span class="text-[13px] font-medium text-slate-900">Orange Money</span>
                        </label>
                        <label class="flex items-center gap-3 border rounded-xl p-3.5 cursor-pointer" :class="paiement === 'mtn_momo' ? 'border-navy-800 bg-navy-900/5' : 'border-slate-200'">
                            <input type="radio" x-model="paiement" value="mtn_momo" class="accent-navy-900">
                            <span class="w-8 h-8 rounded-lg bg-yellow-100 flex items-center justify-center text-yellow-700 font-bold text-[10.5px]">MoMo</span>
                            <span class="text-[13px] font-medium text-slate-900">MTN Mobile Money</span>
                        </label>
                        <label class="flex items-center gap-3 border rounded-xl p-3.5 cursor-pointer" :class="paiement === 'carte' ? 'border-navy-800 bg-navy-900/5' : 'border-slate-200'">
                            <input type="radio" x-model="paiement" value="carte" class="accent-navy-900">
                            <span class="w-8 h-8 rounded-lg bg-teal-50 flex items-center justify-center text-teal-700"><svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1.75 6.417h12.5M1.75 4.25h12.5A1.083 1.083 0 0115.333 5.333v5.834a1.083 1.083 0 01-1.083 1.083H1.75a1.083 1.083 0 01-1.083-1.083V5.333A1.083 1.083 0 011.75 4.25z"/></svg></span>
                            <span class="text-[13px] font-medium text-slate-900">Carte bancaire</span>
                        </label>
                    </div>

                    <p class="text-[12px] text-red-600 mb-3" x-show="error" x-text="error"></p>

                    <button type="button" @click="payer()" :disabled="!paiement || loading" :class="(paiement && !loading) ? '' : 'opacity-40 cursor-not-allowed'" class="w-full bg-coral-500 text-white text-[13px] font-medium py-2.5 rounded-lg hover:bg-coral-600 transition">
                        <span x-show="!loading">Payer <span x-text="tarif.toLocaleString('fr-FR')"></span> FCFA</span>
                        <span x-show="loading">Traitement en cours...</span>
                    </button>
                </div>
            </template>

            <template x-if="step === 'success'">
                <div class="text-center py-4">
                    <div class="w-12 h-12 mx-auto rounded-full bg-teal-50 flex items-center justify-center text-teal-600 mb-4">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <h4 class="text-[14px] font-semibold text-slate-900 mb-1.5">Paiement confirmé</h4>
                    <p class="text-slate-500 text-[13px] leading-relaxed mb-5">
                        Votre <span x-text="flow==='rdv' ? 'rendez-vous' : 'consultation'"></span> avec <span x-text="nom"></span> est confirmé<span x-show="date"> pour le <span x-text="date"></span> à <span x-text="heure"></span></span>.
                    </p>
                    <button type="button" @click="close()" class="bg-navy-900 text-white text-[13px] font-medium px-5 py-2.5 rounded-lg hover:bg-navy-800 transition">
                        <span x-text="flow === 'consulter' ? 'Rejoindre maintenant' : 'Fermer'"></span>
                    </button>
                </div>
            </template>

        </div>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('consultationModal', () => ({
        visible: false, flow: 'consulter', medecinId: null, nom: '', specialite: '', tarif: 0,
        step: 'mode', mode: null, date: '', heure: null, paiement: null, rdvId: null,
        loading: false, error: null,
        today: new Date().toISOString().split('T')[0],
        creneaux: ['09:00','10:00','11:00','14:00','15:00','16:00','17:00'],

        open(detail) {
            Object.assign(this, { flow: detail.flow, medecinId: detail.medecinId, nom: detail.nom, specialite: detail.specialite, tarif: detail.tarif });
            this.step = 'mode'; this.mode = null; this.date = ''; this.heure = null; this.paiement = null; this.error = null; this.rdvId = null;
            this.visible = true;
        },
        close() {
            this.visible = false;
            if (this.flow === 'consulter' && this.step === 'success' && this.rdvId) {
                window.location.href = '/salle/' + this.rdvId;
            }
        },
        csrf() { return document.querySelector('meta[name="csrf-token"]').content; },
        next() {
            if (this.step === 'mode') {
                if (this.flow === 'rdv') { this.step = 'date'; }
                else { this.creerConsultation(); }
            } else if (this.step === 'date') {
                this.creerRdv();
            }
        },
        async creerConsultation() {
            const res = await fetch(`/patient/api/consultation/${this.medecinId}/creer`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': this.csrf() },
                body: JSON.stringify({ mode: this.mode }),
            });
            const data = await res.json();
            this.rdvId = data.id; this.tarif = data.montant;
            this.step = 'paiement';
        },
        async creerRdv() {
            const res = await fetch(`/patient/api/consultation/${this.medecinId}/rdv`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': this.csrf() },
                body: JSON.stringify({ mode: this.mode, date_rdv: this.date, heure_rdv: this.heure }),
            });
            const data = await res.json();
            this.rdvId = data.id; this.tarif = data.montant;
            this.step = 'paiement';
        },
        async payer() {
            this.loading = true; this.error = null;
            try {
                const res = await fetch(`/patient/api/consultation/${this.rdvId}/payer`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': this.csrf() },
                    body: JSON.stringify({ moyen_paiement: this.paiement }),
                });
                if (!res.ok) throw new Error();
                this.step = 'success';
            } catch (e) {
                this.error = "Le paiement a échoué. Réessayez.";
            } finally {
                this.loading = false;
            }
        },
    }));
});
</script>