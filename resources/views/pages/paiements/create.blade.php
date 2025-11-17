@extends('layouts.app')

@section('title', 'Enregistrer un paiement')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">Enregistrer un paiement</h4>

        <form method="post" action="{{ route('paiements.store') }}">
            @csrf

            <div class="mb-3">
                <label for="user_id" class="form-label">Utilisateur</label>
                <select id="user_id" name="users_id" class="form-select @error('user_id') is-invalid @enderror" required>
                    <option value="">-- Choisir un utilisateur --</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}" @selected(old('user_id') == $u->id)>{{ $u->nom }} {{ $u->prenom }} ({{ $u->email ?? '-' }})</option>
                    @endforeach
                </select>
                @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="montant" class="form-label">Montant (F)</label>
                <input type="number" step="0.01" min="0.01" id="montant" name="montant" value="{{ old('montant', 500) }}"
                       class="form-control @error('montant') is-invalid @enderror" required>
                @error('montant') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <div class="form-text">Par défaut 500 F (une semaine). Tu peux entrer 1200, 1500, etc.</div>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Date d'enregistrement (optionnelle)</label>
                <input type="date" id="date" name="date" value="{{ old('date') }}" class="form-control">
                <div class="form-text">Laisser vide = aujourd'hui.</div>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-primary">Enregistrer</button>
                <a href="{{ route('paiements.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
