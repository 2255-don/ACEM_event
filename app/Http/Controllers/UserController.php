<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Entreprise;
use App\Models\Profil;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    //user

    public function index()
    {
        try{
            $entrepriseId = session('entreprise_id');
            $profils = Profil::all();
            $users = User::with('profil:id,libelle')->get()
                                                            ->map(function ($u){
                                                                return [
                                                                    'id'       => $u->id,
                                                                    'nom'      => $u->nom ?? '-',
                                                                    'prenom'   => $u->prenom ?? '-',
                                                                    'email'    => $u->email ?? '-',
                                                                    'profil'   => $u->profil->libelle ?? '-',
                                                                ];
                                                            });
                                                            // dd($users);
            // dd($users);
            return view('pages.gestion.index', 
                ['data' => $users,
                'profils' => $profils,
                ]
            );
        }catch(Exception $e){
            log::error('erreure lors de l\'affichage de la vue'.$e->getMessage());
            // return back()->with('error', $e->getMessage() );b7b4cbe0922c
        }
    }

    public function createForm($id = null)
    {
        try{
            $user = $id ? User::with(['profil'])->findOrFail($id) : null;
            $profils = Profil::all();
            return view('pages.user.form', compact('user', 'profils'));
        }catch(Exception $e){
            log::error('erreure lors de l\'affichage de la vue'.$e->getMessage());
            // return redirect()->route('pages.errors.');
        }

    }

    public function resetUser( $id )
    {
        try{
            $data =[
            'password_changed' => false
        ];
        $plain = 'azerty';
        $data['password'] = Hash::make($plain);
        DB::transaction(function () use ($data, $id) {
           $user = User::updateOrCreate(['id' => $id], $data); 
        });
         session()->flash('success', 'mot de passe de l\'utisteur connecter modifié avec succè');
            return redirect()->route('user.index');
        }catch(Exception $e){
            log::error('error survenu  lors de l\'insertion'.$e->getMessage());

            return back()->with('error', 'error survenu  lors de l\'insertion, veuillez contactez le technicien');
        }
        
    }

    public function storeOrUpdate(Request $request, $id = null)
    {
        try{
            $id = $id ?? null;
            $data = $this->validateUserForm($request->all(), $id);
            // dd($data);
            // if(!$id){
            $data['password'] = Hash::make($data['password']) ?? $data['password'] = Hash::make('azerty');
            // }
            // dd($data);
            DB::transaction(function () use ($data, $id) {
                

                // Insertion dans users
                $user = User::updateOrCreate(['id' => $id], $data);

                // Insertion dans role_user via la relation
            });

            $id ? $m='Utilisateur midifier avec succès': $m='Utilisateur créé avec succès !';
            session()->flash('success', $m);
            return redirect()->route('user.index');
        }catch (ValidationException $e) {
            // RENVOIE les erreurs de validation vers la vue et garde les inputs
            return back()
                ->withErrors($e->errors())   // erreurs affichées par $errors->any() / @error
                ->withInput();               // garde les champs remplis
        } catch (\Throwable $e) {
            Log::error('Erreur lors de l\'insertion : '.$e->getMessage());

            return back()
                ->with('error', 'Une erreur est survenue lors de l\'insertion. Veuillez contacter le technicien.')
                ->withInput();
        }

    }

    public function showUser($id)
    {
        try{
            $entrepriseId = session('entreprise_id');

            $user = User::with(['profil'])->where('entreprises_id', $entrepriseId)->findOrFail($id);

            return redirect()->view('pages.user.show', compact('user'));
        }catch(Exception $e){
            log::error('error survenue  lors de l\'affichage des informations de l\'utilisateur selectionné'.$e->getMessage());
            return back()->with('error', 'Une erreure survenue  lors de l\'affichage des informations de l\'utilisateur selectionné, veuillez contactez le technicien');
        }
    }

    public function delete($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $user = User::findOrFail($id);

                $relations = [
                    'produit',
                    'role_user'
                ];

                foreach ($relations as $relation) {
                    if (method_exists($user, $relation)) {
                        $user->$relation()->delete();
                    }
                }

                $user->delete();
            });

            return back()->with('success', 'Utilisateur supprimé avec succès.');
        } catch (ModelNotFoundException $e) {
            Log::error("Utilisateur introuvable pour la suppression : " . $e->getMessage());
            return back()->with('error', "Utilisateur non trouvé.");
        } catch (\Exception $e) {
            Log::error("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
            return back()->with('error', "Une erreur est survenue lors de la suppression, veuillez contacter le technicien.");
        }
    }

    private function validateUserForm(array $data, $id = null)
    {
        $userId = $id ?? null;
        $rules = [
            'nom' => ['required', 'string', 'max:50'],
            'prenom' => ['nullable', 'string', 'max:50'],
            'email' => [
                'required',
                'email:rfc,dns',
                'string',
                'max:50',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            // 'adresse' => ['required', 'string', 'max:100'],
            // 'telephone' => ['required', 'string', 'max:20'],
            // 'password' => ['nullable','min:8'],
            'password' => ['nullable','confirmed','min:8'],
            'profils_id' =>['required'],
            
        ];

        $messages = [
            'nom.required' => "Le nom est obligatoire.",
            'prenom.required' => "Le prénom est obligatoire.",
            'email.required' => "L'email est obligatoire.",
            'email.email' => "L'email doit être valide et exister (RFC/DNS).",
            'email.unique' => "Cet email est déjà utilisé.",
            'adresse.required' => "L'adresse est obligatoire.",
            'proils_id.required' => "Le profil est obligatoire.",
            'roles_id.required' => "Le profil est obligatoire.",
            'telephone.required' => "Le numéro de téléphone est obligatoire.",
            'password.confirmed' => "'Le mot de passe de confirmation ne correspond pas",
            'password.min' => "le mot de passe doit contenir au moins 8 carateres",
        ];

        return validator($data, $rules, $messages)->validate();
    }


}
