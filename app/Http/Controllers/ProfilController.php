<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Profil;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfilController extends Controller
{
    //
    public function profil()
    {
        try{
            $profils = Profil::all();
            return view('pages.profil.index', compact('profils'));
        }catch(Exception $e){
            log::error('erreure lors de l\'affichage de la vue'.$e->getMessage());
            return redirect()->route('pages.errors.');
        }
    }

    public function storeOrUpdate(Request $request, $id = null)
    {
        try{
            $id = $id ?? null;
            $data = $this->validateprofilForm($request->all());
            DB::transaction(function() use($data, $id) {
                Profil::updateOrCreate(
                    ['id' => $id],
                    $data
                );
            });
        }catch(Exception $e){
            log::error('error survenu  lors de l\'insertion'.$e->getMessage());
            return back()->with('error', 'error survenu  lors de l\'insertion, veuillez contactez le technicien');
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {
                $profil = Profil::find($id);

                $relations = [
                    'users'
                ];

                foreach ($relations as $relation) {
                    if (method_exists($profil, $relation)) {
                        $profil->$relation()->update(['profils_id' => null]);
                    }
                }

                $profil->delete();
            DB::commit();
            
             return response()->json([
                'success' => true,
                'message' => 'Role supprimé avec succès.'
            ]);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            Log::error("profil introuvable pour la suppression : " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Role introuvable'
            ], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur lors de la suppression du profil : " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression du Role'
            ], 500);        
}
    }

    private function validateprofilForm(array $data)
    {
        $rules = [
            'libelle' => ['required', 'string', 'max:50', 'unique:profils,libelle'],
        ];

        $messages = [
            'libelle.required' => "L'email est obligatoire.",
            'libelle.unique' => "Cet profil est déjà dans la base.",
        ];

        return validator($data, $rules, $messages)->validate();
    }
}

