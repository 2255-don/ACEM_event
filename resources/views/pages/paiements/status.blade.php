@php
    use Carbon\Carbon;
    $now = Carbon::now();
@endphp

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Statut utilisateur</h5>

        @if(! $abonnement)
            <div class="alert alert-warning">Aucun abonnement trouvé pour cet utilisateur.</div>
        @else
            <p><strong>Start_date :</strong> {{ $abonnement->start_date->format('Y-m-d') }}</p>
            <p><strong>Montant / semaine :</strong> {{ number_format($abonnement->montant_par_semaine,2) }} F</p>

            <hr>

            <p><strong>Semaines dues (jusqu'à aujourd'hui) :</strong> {{ $abonnement->weeksDue($now) }}</p>
            <p><strong>Montant attendu :</strong> {{ number_format($abonnement->expectedAmount($now),2) }} F</p>
            <p><strong>Total payé :</strong> {{ number_format($abonnement->totalPaid($now),2) }} F</p>
            <p><strong>Reste à payer :</strong> {{ number_format($abonnement->remainingAmount($now),2) }} F</p>

            <div class="mt-3">
                @if($abonnement->isUpToDate($now))
                    <span class="badge bg-success">À jour</span>
                @else
                    <span class="badge bg-danger">En retard</span>
                @endif
            </div>
        @endif
    </div>
</div>
