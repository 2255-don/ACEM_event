<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="bg-light text-secondary">
            <tr>
                <th>#</th>
                <th>Num fact</th>
                <th>Fournisseur</th>
                <th>Total</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Facture</th>
            </tr>
        </thead>
        <tbody>
            @forelse($facturesCommandes as $f)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $f->numero_facture }}</td>
                <td>{{ $f->commandes->fournisseur->nom ?? '-' }}</td>
                <td>{{ number_format($f->montant_total, 0, ',', ' ') }} CFA</td>
                <td>{{ $f->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <span class="badge {{ $f->statut === 'reglée' ? 'bg-success' : 'bg-warning' }}">
                        {{ ucfirst($f->statut) }}
                    </span>
                </td>
                <td>
                    @if($f->statut !== 'reglée')
                        <button 
                            class="btn btn-sm btn-outline-success regler-facture-btn"
                            data-id="{{ $f->id }}">
                            <i class="ti ti-cash"></i> Régler
                        </button>
                    @endif
                    <a href="{{ asset('storage/' . $f->fichier) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                        <i class="ti ti-file-invoice"></i> Voir
                    </a>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center text-muted py-3">Aucune facture fournisseur.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
