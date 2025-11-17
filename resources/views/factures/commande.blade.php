<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture Commande - {{ $facture->numero_facture }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 13px; margin: 30px; }
        header { text-align: center; margin-bottom: 25px; }
        header img { height: 60px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { text-align: right; margin-top: 15px; font-size: 15px; font-weight: bold; }
        .footer { text-align: center; margin-top: 40px; font-size: 12px; }
        .signature { margin-top: 50px; text-align: right; }
    </style>
</head>
<body>
<header>
    @if($entreprise && $entreprise->logo)
        <img src="{{ public_path('storage/' . $entreprise->logo) }}" alt="Logo entreprise">
    @endif
    <h2>{{ $entreprise->nom ?? 'Entreprise' }}</h2>
    <p>Facture Commande - {{ $facture->numero_facture }}</p>
</header>

<p><strong>Date :</strong> {{ now()->format('d/m/Y H:i') }}</p>

<table>
    <thead>
        <tr>
            <th>Produit</th>
            <th>Fournisseur</th>
            <th>Quantité</th>
            <th>Prix unitaire</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($commande->detailCommandes as $d)
        <tr>
            <td>{{ $d->produits->libelle ?? '' }}</td>
            <td>{{ $d->fournisseurs->nom ?? '' }}</td>
            <td>{{ $d->quantite }}</td>
            <td>{{ number_format($d->prix_unitaire, 0, ',', ' ') }} CFA</td>
            <td>{{ number_format($d->prix, 0, ',', ' ') }} CFA</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="total">
    Montant total : {{ number_format($facture->montant_total, 0, ',', ' ') }} CFA
</div>

<div class="signature">
    <p>__________________________</p>
    <p>Signature du régisseur</p>
</div>

<div class="footer">
    {{ $entreprise->nom ?? 'Entreprise' }} — {{ $entreprise->adresse ?? '' }}<br>
    Téléphone : {{ $entreprise->telephone ?? '---' }}
</div>
</body>
</html>
