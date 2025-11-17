<?php

namespace Database\Seeders;

use App\Models\Abonnement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbonnementInitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $lastSundayOct2025 = Carbon::create(2025,10,31)->startOfDay();
        while ($lastSundayOct2025->dayOfWeek !== Carbon::SUNDAY) {
            $lastSundayOct2025->subDay();
        }
        $date = $lastSundayOct2025->toDateString();

        $users = User::all();
        foreach ($users as $user) {
            // skip if user already has abonnement
            if ($user->abonnement) continue;

            Abonnement  ::create([
                'users_id' => $user->id,
                'start_date' => $date,
                'montant_par_semaine' => 500.00,
            ]);
        }
    }
}
