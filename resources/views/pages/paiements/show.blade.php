@extends('layouts.app')

@section('title', 'Détail paiement')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Détail du paiement</h4>
    <a href="{{ route('paiements.index') }}" class="btn btn-outline-secondary btn-sm">Retour</a>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Paiement</h5>
                <p><strong>Id :</strong> {{ $paiement->id }}</p>
                <p><strong>Date :</strong> {{ $paiement->created_at->format('Y-m-d H:i') }}</p>
                <p><strong>Utilisateur :</strong> {{ $user->nom }} {{ $user->prenom }}</p>
                <p><strong>Montant :</strong> {{ number_format($paiement->montant,2) }} F</p>
                <p><strong>Semaines couvertes :</strong> {{ $paiement->weeks_covered ?? 0 }}</p>
                <p><strong>Reste global :</strong> {{ number_format($paiement->reste_a_payer ?? 0,2) }} F</p>
                <p><strong>Commentaire :</strong> {{ $paiement->commentaire }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Semaines couvertes par ce paiement</h5>
                @if($paiement->semaines->isEmpty())
                    <p class="text-muted">Aucune semaine allouée (paiement non attribué).</p>
                @else
                    <ul class="list-group">
                        @foreach($paiement->semaines as $s)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $s->sunday_date->format('Y-m-d') }}</strong>
                                    <div class="small text-muted">Montant appliqué : {{ number_format($s->montant_applique,2) }} F</div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        @include('pages.paiements._status', ['user' => $user, 'abonnement' => $abonnement])
    </div>
</div>
@endsection
