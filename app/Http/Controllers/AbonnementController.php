<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbonnementController extends Controller
{
    // Vue create (form)
    public function create()
    {
        $users = User::orderBy('nom')->get();
        return view('pages.abonnements.create', compact('users'));
    }

    // Store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'users_id' => 'required|exists:users,id|unique:abonnements,users_id',
            'start_date' => 'required|date',
            'montant_par_semaine' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ab = Abonnement::create([
            'users_id' => $request->users_id,
            'start_date' => Carbon::parse($request->start_date)->toDateString(),
            'montant_par_semaine' => round((float)$request->montant_par_semaine, 2),
        ]);

        return redirect()->route('paiements.index')->with('success', 'Abonnement créé avec succes.');
    }

    // Edit form
    public function edit($id)
    {
        $ab = Abonnement::findOrFail($id);
        return view('abonnements.edit', compact('ab'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $ab = Abonnement::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'montant_par_semaine' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ab->update([
            'start_date' => Carbon::parse($request->start_date)->toDateString(),
            'montant_par_semaine' => round((float)$request->montant_par_semaine, 2),
        ]);

        return redirect()->route('paiements.show', $ab->user->paiements()->latest()->first()?->id ?? null)
            ->with('success', 'Abonnement mis à jour.');
    }

    // Destroy (optionnel)
    public function destroy($id)
    {
        $ab = Abonnement::findOrFail($id);
        $ab->delete();
        return redirect()->route('paiements.index')->with('success', 'Abonnement supprimé.');
    }

    /**
     * Helper public static pour calculer le dernier dimanche d'octobre 2025.
     * Utile pour le seeder / remplissage.
     */
    public static function lastSundayOfOctober2025(): string
    {
        $d = Carbon::create(2025, 10, 31)->startOfDay();
        // reculer jusqu'au dimanche
        while ($d->dayOfWeek !== Carbon::SUNDAY) {
            $d->subDay();
        }
        return $d->toDateString();
    }
}
