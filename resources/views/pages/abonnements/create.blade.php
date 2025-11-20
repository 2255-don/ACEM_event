@extends('layouts.app')

@section('title', 'Créer Abonnement')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="mb-3">Créer abonnement</h4>

        <form action="{{ route('abonnements.store') }}" method="post">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h5 class="mb-2">Veuillez corriger les erreurs suivantes :</h5>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-3">
                <label class="form-label">Utilisateur</label>
                <select name="users_id" class="form-select @error('users_id') is-invalid @enderror" required>
                    <option value="">-- Choisir --</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}" @selected(old('users_id') == $u->id)>{{ $u->nom }} {{ $u->prenom }}</option>
                    @endforeach
                </select>
                @error('users_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Date de départ (start_date)</label>
                <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
                       value="{{ old('start_date', \App\Http\Controllers\AbonnementController::lastSundayOfOctober2025()) }}" required>
                @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <div class="form-text">Par défaut = dernier dimanche d'octobre 2025.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Montant par semaine (F)</label>
                <input type="number" step="0.01" min="0" name="montant_par_semaine" class="form-control @error('montant_par_semaine') is-invalid @enderror"
                       value="{{ old('montant_par_semaine', 500) }}" required>
                @error('montant_par_semaine') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-primary">Créer</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
