@extends('layouts.app')

@section('title', 'Liste des paiements')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Paiements</h3>
   @can('access-admin')
       <a href="{{ route('paiements.create') }}" class="btn btn-success">Nouveau paiement</a>
   @endcan 
</div>
@can('access-admin')

    <form method="get" class="row g-2 mb-3">
        <div class="col-auto">
            <select name="user_id" class="form-select">
                <option value="">-- Filtrer par utilisateur --</option>
                @foreach($users as $u)
                    <option value="{{ $u->id }}" @selected(request('user_id') == $u->id)>{{ $u->nom }} {{ $u->prenom }}</option>
                @endforeach
            </select>
        </div>
            <div class="col-auto">
                <button class="btn btn-primary">Filtrer</button>
                <a href="{{ route('paiements.index') }}" class="btn btn-outline-secondary">Effacer</a>
            </div>
    </form>
    @endcan

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Utilisateur</th>
                        <th>Montant</th>
                        <th>Semaines couvertes</th>
                        <th>Reste global</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($paiements as $p)
                    <tr>
                        <td>{{ $p->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $p->user->nom ?? '-' }} {{ $p->user->prenom ?? '' }}</td>
                        <td>{{ number_format($p->montant, 2) }} F</td>
                        <td>{{ $p->weeks_covered ?? 0 }}</td>
                        <td>{{ number_format($p->reste_a_payer ?? 0, 2) }} F</td>
                        <td>
                            <a href="{{ route('paiements.show', $p->id) }}" class="btn btn-sm btn-outline-primary">Voir</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-3">Aucun paiement trouvé.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $paiements->links() }}
</div>
@endsection
