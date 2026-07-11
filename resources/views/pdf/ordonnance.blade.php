<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; color: #0f172a; font-size: 13px; }
        .header { border-bottom: 3px solid #0B3A66; padding-bottom: 14px; margin-bottom: 24px; }
        .header h1 { color: #0B3A66; font-size: 20px; margin: 0; }
        .header p { color: #64748b; font-size: 11px; margin: 4px 0 0; }
        .row { display: flex; justify-content: space-between; margin-bottom: 6px; }
        .label { color: #64748b; font-size: 11px; }
        .box { background: #F2F9F7; border-radius: 6px; padding: 16px; margin-top: 16px; }
        .footer { margin-top: 40px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Ordonnance médicale</h1>
        <p>SuiviHealth — Plateforme de consultation et de suivi médical</p>
    </div>

    <div class="row"><span class="label">Patient:</span><strong> {{ $ordonnance->patient->user->name }}</strong></div>
    <div class="row"><span class="label">Médecin prescripteur:</span><strong> {{ $ordonnance->medecin->user->name }}</strong></div>
    <div class="row"><span class="label">Spécialité:</span><strong> {{ $ordonnance->medecin->specialite }}</strong></div>
    <div class="row"><span class="label">Date de prescription:</span><strong> {{ $ordonnance->date_prescription->format('d/m/Y') }}</strong></div>

    <div class="box">
        <p class="label" style="margin-bottom:8px;">MÉDICAMENTS PRESCRITS</p>
        <p style="white-space: pre-line;"> {{ $ordonnance->medicaments }}</p>
    </div>

    @if ($ordonnance->instructions)
    <div class="box">
        <p class="label" style="margin-bottom:8px;">INSTRUCTIONS</p>
        <p style="white-space: pre-line;"> {{ $ordonnance->instructions }}</p>
    </div>
    @endif

    <div class="footer">
        <p class="label">Signature du médecin</p>
        <p style="margin-top:40px;">___________________________</p>
    </div>
</body>
</html>