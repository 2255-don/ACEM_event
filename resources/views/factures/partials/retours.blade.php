<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="bg-light text-secondary">
            <tr>
                <th>#</th>
                <th>Num fact</th>
                <th>Produit</th>
                <th>Client</th>
                <th>Type retour</th>
                <th>Montant</th>
                <th>Date</th>
                <th>Reçu</th>
            </tr>
        </thead>
        <tbody>
            @forelse($facturesRetours as $f)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $f->numero_facture }}</td>
                <td>{{ $f->ventes->produits->first()->libelle ?? '-' }}</td>
                <td>{{ $f->ventes->client->nom ?? '-' }}</td>
                <td><span class="badge bg-danger">Retour</span></td>
                <td>-{{ number_format($f->montant_total, 0, ',', ' ') }} CFA</td>
                <td>{{ $f->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ asset('storage/' . $f->fichier) }}" target="_blank" class="btn btn-sm btn-outline-danger">
                        <i class="ti ti-file-text"></i> Voir
                    </a>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center text-muted py-3">Aucun retour enregistré.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
