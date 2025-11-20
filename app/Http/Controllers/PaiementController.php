<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\User;
use App\Services\PaymentRecordingService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PaiementController
{
    protected $paymentService;

    public function __construct(PaymentRecordingService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Liste des paiements (option : filtrer par user)
     */
    public function index(Request $request)
    {
        if(Auth::user()->profil->libelle == 'Super-admin' || Auth::user()->profil->libelle == 'admin'){

            $query = Paiement::with('user')->orderBy('created_at', 'DESC');
        }else{
            $query = Paiement::with('user')->where('users_id', Auth::user()->id)->orderBy('created_at', 'DESC');
        }

        if ($request->filled('users_id')) {
            $query->where('users_id', $request->users_id);
        }

        return response()->json([
            'paiements' => $query->paginate(20)
        ]);
    }

    /**
     * Enregistrer un paiement (via admin)
     */
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'users_id' => ['required', 'exists:users,id'],
            'montant' => ['required', 'numeric', 'min:1'],
            'date'    => ['nullable', 'date', 'after_or_equal:today'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $date = $request->date ? Carbon::parse($request->date) : null;

            // Enregistrement via le service
            $paiement = $this->paymentService->record(
                $request->users_id,
                $request->montant,
                $date
            );

             $m='Paiement effectuer avec succès';
            session()->flash('success', $m);
            return redirect()->route('paiements.index');
        } catch (\Throwable $e) {
            session()->flash('error', 'une errreure est survenue lors de l\'enregistrement du paiement');
            Log::error('erreure', $e->getMessage());
            return back();
        }
    }

    /**
     * Afficher un paiement précis
     */
    public function show($id)
    {
        $paiement = Paiement::with('semaines', 'user')->find($id);

        if (! $paiement) {
            return response()->json([
                'status' => 'error',
                'message' => 'Paiement introuvable.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'paiement' => $paiement
        ]);
    }

    /**
     * Situation d’un utilisateur :
     * - nombre de dimanches dus
     * - total payé
     * - montant attendu
     * - reste à payer
     * - est à jour ?
     */
    public function userStatus($userId)
    {
        $user = User::with('abonnement')->find($userId);

        if (! $user || ! $user->abonnement) {
            return response()->json([
                'status' => 'error',
                'message' => 'Utilisateur ou abonnement introuvable.'
            ], 404);
        }

        $ab = $user->abonnement;
        $now = Carbon::now();

        $weeksDue = $ab->weeksDue($now);
        $expected = $ab->expectedAmount($now);
        $paid = $ab->totalPaid($now);
        $remaining = $ab->remainingAmount($now);

        return response()->json([
            'status' => 'success',
            'user' => [
                'id' => $user->id,
                'nom' => $user->nom,
                'prenom' => $user->prenom
            ],
            'abonnement' => [
                'start_date' => $ab->start_date,
                'weeks_due' => $weeksDue,
                'montant_par_semaine' => $ab->montant_par_semaine,
                'expected' => $expected,
                'paid' => $paid,
                'remaining' => $remaining,
                'is_up_to_date' => $remaining <= 0,
            ]
        ]);
    }

    /**
     * (Optionnel) Supprimer un paiement
     */
    public function destroy($id)
    {
        $paiement = Paiement::find($id);

        if (! $paiement) {
            return response()->json([
                'status' => 'error',
                'message' => 'Paiement introuvable.'
            ], 404);
        }

        // Suppression simple (à améliorer selon besoin)
        $paiement->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Paiement supprimé.'
        ]);
    }


    // ... constructeur et méthodes existantes ...

    /**
     * Vue Blade: liste des paiements
     */
    public function indexView(Request $request)
    {
        if(Auth::user()->profil->libelle == 'Super-admin' || Auth::user()->profil->libelle == 'admin'){

            $query = Paiement::with('user')->orderBy('created_at', 'DESC');
        }else{
            $query = Paiement::with('user')->where('users_id', Auth::user()->id)->orderBy('created_at', 'DESC');
        }
        if ($request->filled('users_id')) {
            $query->where('users_id', $request->users_id);
        }
        $paiements = $query->paginate(20)->withQueryString();
        $users = User::orderBy('nom')->get();

        return view('pages.paiements.index', compact('paiements', 'users'));
    }

    /**
     * Vue Blade: form création paiement
     */
    public function createView()
    {
        $users = User::orderBy('nom')->get();
        return view('pages.paiements.create', compact('users'));
    }

    /**
     * Vue Blade: detail / status du paiement (ou de l'utilisateur)
     */
    public function showView($id)
    {
        $paiement = Paiement::with('semaines', 'user')->findOrFail($id);
        $user = $paiement->user;
        $abonnement = $user->abonnement ?? null;

        return view('pages.paiements.show', compact('paiement', 'user', 'abonnement'));
    }

    /**
     * Vue Blade: statut utilisateur (page autonome)
     */
    public function userStatusView($userId)
    {
        $user = User::with('abonnement')->findOrFail($userId);
        $ab = $user->abonnement;
        return view('pages.paiements.status', compact('user', 'ab'));
    }
}
