<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu de retour - {{ $facture->numero_facture }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            background: #fff;
            color: #222;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        .recu {
            width: 320px;
            margin: auto;
            border: 1px dashed #888;
            padding: 12px;
        }
        .header {
            text-align: center;
            border-bottom: 1px dashed #999;
            padding-bottom: 6px;
            margin-bottom: 10px;
        }
        .header img {
            width: 50px;
            height: auto;
            margin-bottom: 5px;
        }
        .header h3 {
            margin: 0;
            text-transform: uppercase;
            font-size: 14px;
        }
        .info {
            margin-bottom: 10px;
        }
        .info p {
            margin: 2px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        th, td {
            padding: 4px 0;
            text-align: left;
        }
        th {
            border-bottom: 1px solid #ccc;
            font-size: 11px;
        }
        .total {
            text-align: right;
            border-top: 1px dashed #aaa;
            margin-top: 5px;
            padding-top: 5px;
            font-weight: bold;
        }
        .motif {
            margin-top: 10px;
            font-style: italic;
            font-size: 11px;
            color: #555;
        }
        .signature {
            margin-top: 20px;
            text-align: right;
            font-size: 11px;
        }
        .footer {
            text-align: center;
            margin-top: 10px;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="recu">
        <div class="header">
            @if($entreprise && $entreprise->logo)
                <img src="{{ public_path('storage/' . $entreprise->logo) }}" alt="Logo">
            @endif
            <h3>{{ strtoupper($entreprise->nom ?? 'MON ENTREPRISE') }}</h3>
            <p><small>{{ $entreprise->adresse ?? '' }}</small></p>
            <h4 style="margin:5px 0;color:#007bff;">REÇU DE RETOUR</h4>
        </div>

        <div class="info">
            <p><strong>N° Reçu :</strong> {{ $facture->numero_facture }}</p>
            <p><strong>Date :</strong> {{ $facture->created_at->format('d/m/Y H:i') }}</p>
            @if($retour->vente && $retour->vente->client)
                <p><strong>Client :</strong> {{ $retour->vente->client->nom ?? '' }} {{ $retour->vente->client->prenom ?? '' }}</p>
            @endif
            <p><strong>Type de retour :</strong> {{ ucfirst($retour->type_retour) }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Qté</th>
                    <th>Montant</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $retour->produit->libelle ?? '—' }}</td>
                    <td>{{ $retour->quantite }}</td>
                    <td>-{{ number_format($retour->montant_total, 0, ',', ' ') }} CFA</td>
                </tr>
            </tbody>
        </table>

        <p class="total">
            Montant total : -{{ number_format($facture->montant_total, 0, ',', ' ') }} CFA
        </p>

        @if($retour->motif)
            <div class="motif">
                <p><strong>Motif :</strong> {{ $retour->motif }}</p>
            </div>
        @endif

        <div class="signature">
            <p>Établi par : {{ Auth::user()->nom ?? 'Utilisateur' }}</p>
            <p>Signature :</p>
            <p>_________________________</p>
        </div>

        <div class="footer">
            <p>Merci de votre confiance.</p>
            <p>{{ $entreprise->nom ?? '' }} © {{ date('Y') }}</p>
        </div>
    </div>
</body>
</html>
