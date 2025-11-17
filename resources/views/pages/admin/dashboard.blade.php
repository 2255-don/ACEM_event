@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Dashboard Admin</h3>
    <div>
        <a href="{{ route('paiements.create') }}" class="btn btn-success">Enregistrer un paiement</a>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">Solde caisse</h6>
                <h4>{{ number_format($balanceCaisse, 2) }} F</h4>
                <small class="text-muted">Entrées - Sorties</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">Total attendu (jusqu'à aujourd'hui)</h6>
                <h4>{{ number_format($totalExpected, 2) }} F</h4>
                <small class="text-muted">Montant théorique dû</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">Total payé</h6>
                <h4>{{ number_format($totalPaid, 2) }} F</h4>
                <small class="text-muted">Somme des paiements enregistrés</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">Utilisateurs en retard</h6>
                <h4>{{ $debtorsCount }}</h4>
                <small class="text-muted">Nombre d'utilisateurs avec arriérés</small>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4 g-3">
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Paiements hebdomadaires ({{ count($chartLabels) }} semaines)</h5>
                <canvas id="paymentsChart" height="120"></canvas>
            </div>
        </div>

        <div class="card mt-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Derniers paiements</h5>
                @if($recentPayments->isEmpty())
                    <p class="text-muted">Aucun paiement récent.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Utilisateur</th>
                                    <th>Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentPayments as $p)
                                <tr>
                                    <td>{{ $p->created_at->format('Y-m-d H:i') }}</td>
                                    <td>{{ $p->user->nom ?? '-' }} {{ $p->user->prenom ?? '' }}</td>
                                    <td>{{ number_format($p->montant,2) }} F</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Top débiteurs ({{ $topDebtors->count() }})</h5>

                @if($topDebtors->isEmpty())
                    <p class="text-muted">Aucun débiteur pour l'instant.</p>
                @else
                    <div class="list-group">
                        @foreach($topDebtors as $d)
                            <div class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-3">
                                    <strong>{{ $d['nom'] }} {{ $d['prenom'] }}</strong>
                                    <div class="small text-muted">{{ $d['email'] ?? '-' }}</div>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold text-danger">{{ number_format($d['remaining'],2) }} F</div>
                                    <div class="small text-muted">Payé: {{ number_format($d['total_paid'],2) }} F</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="mt-3">
                    <a href="{{ route('paiements.index') }}" class="btn btn-sm btn-outline-primary">Voir tous les paiements</a>
                    <a href="{{ route('paiements.create') }}" class="btn btn-sm btn-success">Enregistrer paiement</a>
                </div>
            </div>
        </div>

        <div class="card mt-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Actions rapides</h5>
                <a href="{{ route('paiements.create') }}" class="btn btn-primary btn-sm w-100 mb-2">Nouveau paiement</a>
                <a href="{{ route('paiements.index') }}" class="btn btn-outline-secondary btn-sm w-100">Liste paiements</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    (function () {
        const ctx = document.getElementById('paymentsChart').getContext('2d');
        const labels = @json($chartLabels);
        const data = @json($chartData);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Paiements (F) par semaine (début semaine)',
                    data: data,
                    // couleurs laissées par défaut (Chart.js choisit)
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { display: true, title: { display: true, text: 'Début semaine (dimanche)' } },
                    y: { display: true, title: { display: true, text: 'Montant (F)' }, beginAtZero: true }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: { mode: 'index', intersect: false }
                }
            }
        });
    })();
</script>
@endsection
