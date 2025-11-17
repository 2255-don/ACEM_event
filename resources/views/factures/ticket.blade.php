<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu - {{ $facture->numero_facture }}</title>
    <style>
        body { font-family: "Arial", sans-serif; margin: 20px; font-size: 13px; }
        .header { text-align: center; margin-bottom: 15px; }
        .header img { width: 60px; }
        .info { margin-bottom: 15px; }
        .items table { width: 100%; border-collapse: collapse; }
        .items th, .items td { padding: 6px; border-bottom: 1px dashed #aaa; text-align: left; }
        .total { text-align: right; margin-top: 10px; font-size: 14px; font-weight: bold; }
        .footer { text-align: center; font-size: 11px; margin-top: 15px; border-top: 1px dashed #aaa; padding-top: 8px; }
    </style>
</head>
<body>
    <div class="header">
        @if($entreprise && $entreprise->logo)
            <img src="{{ public_path('storage/' . $entreprise->logo) }}" alt="Logo">
        @endif
        <h3>{{ $entreprise->nom ?? 'Entreprise' }}</h3>
        <p>Reçu de vente - {{ $facture->numero_facture }}</p>
    </div>

    <div class="info">
        <p><strong>Client :</strong> {{ $vente->client->nom ?? '---' }}</p>
        <p><strong>Date :</strong> {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="items">
        <table>
            <thead>
                <tr><th>Produit</th><th>Prix.U</th><th>Qté</th><th>Total</th></tr>
            </thead>
            <tbody>
                @foreach($vente->produits as $p)
                <tr>
                    <td>{{ $p->libelle }}</td>
                    <td>{{ $p->prix_unitaire }}</td>
                    <td>{{ $p->pivot->quantite }}</td>
                    <td>{{ number_format($p->pivot->prix, 0, ',', ' ') }} CFA</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="total">
        Total : {{ number_format($vente->total, 0, ',', ' ') }} CFA
    </div>

    <div class="footer">
        Merci pour votre achat ! <br>
        <em>{{ $entreprise->nom ?? 'Entreprise' }} — {{ $entreprise->adresse ?? '' }}</em>
    </div>
</body>
</html>
