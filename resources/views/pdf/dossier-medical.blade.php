<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; color: #0f172a; font-size: 12px; }
        .header { border-bottom: 3px solid #0B3A66; padding-bottom: 14px; margin-bottom: 20px; }
        .header h1 { color: #0B3A66; font-size: 19px; margin: 0; }
        .header p { color: #64748b; font-size: 11px; margin: 4px 0 0; }
        .section-title { color: #0B3A66; font-size: 13px; font-weight: bold; margin: 20px 0 8px; border-bottom: 1px solid #e2e8f0; padding-bottom: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 6px; }
        th { text-align: left; background: #F2F9F7; color: #1E9E6B; font-size: 10px; padding: 6px 8px; }
        td { padding: 6px 8px; border-bottom: 1px solid #f1f5f9; font-size: 11px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Dossier médical complet</h1>
        <p>{{ $patient->user->name }} — Généré le {{ now()->format('d/m/Y à H:i') }} — SuiviHealth</p>
    </div>

    <p><strong>Sexe :</strong> {{ $patient->sexe === 'M' ? 'Homme' : ($patient->sexe === 'F' ? 'Femme' : 'Non renseigné') }} &nbsp;&nbsp;
    <strong>Groupe sanguin :</strong> {{ $patient->groupe_sanguin ?? 'Non renseigné' }} &nbsp;&nbsp;
    <strong>Téléphone :</strong> {{ $patient->telephone ?? 'Non renseigné' }}</p>

    <div class="section-title">Symptômes signalés</div>
    <table>
        <tr><th>Titre</th><th>Description</th><th>Gravité</th><th>Date</th></tr>
        @forelse ($symptomes as $s)
            <tr><td>{{ $s->titre }}</td><td>{{ $s->description }}</td><td>{{ ucfirst($s->gravite) }}</td><td>{{ $s->created_at->format('d/m/Y') }}</td></tr>
        @empty
            <tr><td colspan="4">Aucun symptôme enregistré.</td></tr>
        @endforelse
    </table>

    <div class="section-title">Constantes de santé</div>
    <table>
        <tr><th>Type</th><th>Valeur</th><th>Date</th></tr>
        @forelse ($constantes as $c)
            <tr>
                <td>{{ ucfirst($c->type) }}</td>
                <td>
                    @if ($c->type === 'tension') {{ $c->valeur }}/{{ $c->valeur_secondaire }} mmHg
                    @else {{ $c->valeur }} {{ $c->type === 'poids' ? 'kg' : ($c->type === 'glycemie' ? 'g/L' : '°C') }}
                    @endif
                </td>
                <td>{{ $c->created_at->format('d/m/Y') }}</td>
            </tr>
        @empty
            <tr><td colspan="3">Aucune constante enregistrée.</td></tr>
        @endforelse
    </table>
</body>
</html>