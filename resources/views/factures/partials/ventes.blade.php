<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="bg-light text-secondary">
            <tr>
                <th>#</th>
                <th>Num fact</th>
                <th>Client</th>
                <th>Total</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Reçu</th>
            </tr>
        </thead>
        <tbody>
            @forelse($facturesVentes as $f)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $f->numero_facture }}</td>
                <td>{{ $f->ventes->client->nom ?? '-' }}</td>
                <td>{{ number_format($f->montant_total, 0, ',', ' ') }} CFA</td>
                <td>{{ $f->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <span class="badge bg-success">{{ ucfirst($f->statut) }}</span>
                </td>
                <td>
                    <a href="{{ asset('storage/' . $f->fichier) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                        <i class="ti ti-file-text"></i> Voir
                    </a>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center text-muted py-3">Aucune facture de vente.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
