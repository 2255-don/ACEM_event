<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    //
    public function switch(Request $request)
    {
        $id = $request->entreprise_id;

        if ($id && Entreprise::find($id)) {
            session(['entreprise_id' => $id]);
            return back()->with('success', 'Contexte changé vers l’entreprise sélectionnée.');
        }

        session()->forget('entreprise_id');
        return back()->with('success', 'Mode global activé.');
    }
}
