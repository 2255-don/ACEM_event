<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;



Schedule::call(function () {
    $now = \Carbon\Carbon::now();
    Log::info('Vérification des licences expirées lancée à : ' . $now);
    $licencesUpdated = \App\Models\Licence::where('etat', 'active')
        ->where('date_fin', '<', $now)
        ->update(['etat' => 'expired']);
    Log::info('Nombre de licences mises à jour : ' . $licencesUpdated);
    // Vous pouvez également logger des informations sur les licences trouvées avant la mise à jour
    $licencesAVerifier = \App\Models\Licence::where('etat', 'active')
        ->where('date_fin', '<', $now)
        ->get();
    Log::info('Licences à vérifier : ' . $licencesAVerifier);
})->everySecond();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
