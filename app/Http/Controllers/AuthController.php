<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Licence;
use Exception;


class AuthController extends Controller
{
    //
    public function login()
    {
        return view('pages.auth.login');
    }

    public function doLogin(Request $request)
    {
        try{
            $user = $this->validateLoginForm($request->all());
            if(Auth::attempt($user)){
                $request->session()->regenerate();

                // $now = Carbon::now();

                // Licence::where('etat', 'active')
                //     ->where('date_fin', '<', $now)
                //     ->update(['etat' => 'expired']);

                if(!Auth::user()->password_changed){
                    return redirect()->route('admin.password-change');
                }
                session()->flash('success', "connexion reussi !");
                return redirect()->route('admin.dashboard');
            }

            session()->flash('error', "Identifiants invalides !");
            return back();
        }catch(Exception $e){
            log::error('erreur lors de la tentative d\'authentification'. $e->getMessage());
            return back()->with([
            'error', 'Une erreur est survenue. Veuillez réessayer.'
        ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function resetPasswordForm()
    {
        return view('pages.atuh.reset_password');
    }

    public function resetPasswordStore(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }


    public function passwordChangeForm()
    {
        return view('pages.auth.password_change');
    }

    public function passwordChangeStore(Request $request)
    {
        $data = $this->validatepasswordChangeForm($request->all());

        try{
            $user = Auth::user();
            $password = $data['password'];
            DB::transaction(fn() => $user->update([
                'password' => $password,
                'password_changed' => true,
            ]));

            return redirect('/dashboard')->with('success', 'Mot de passe modifié avec succès');
        }catch(Exception $e){
            log::Error('erreure lors de la modification de mot de passe'.$e->getMessage());
            return redirect()->back()->with('error', 'Oups une erreure est survenue lors de la modification de mode passe veuillez contactez le technicien.');
        }
    }


    // 'email:rfc,dns',

    private function validateLoginForm(array $data)
    {
        $rules = [
            'email' => ['required', 'email', 'string', 'max:50'],
            'password' => ['required']
        ];

        $messages = [
            'email.required' => "'L'email est obligatoire",
            'email.email' => "choisissez un bon format d'email ou un email exxistant.",
            'password.required' => "'Le mot de passe est obligatoire",

        ];

        return validator($data, $rules, $messages)->validate();
    }

    private function validatepasswordChangeForm($data)
    {
        $rules = [
            'password' => ['required', 'confirmed','min:8']
        ];

        $messages = [
            'password.min' => "le mot de passe doit contenir au moins 8 carateres",
            'password.required' => "Le mot de passe est obligatoire",
            'password.confirmed' => "'Le mot de passe de confirmation ne correspond pas",
        ];

        return validator($data, $rules, $messages)->validate();
    }

}
