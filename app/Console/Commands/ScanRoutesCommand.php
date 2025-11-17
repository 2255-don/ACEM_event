<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Models\Feature;
use Illuminate\Support\Str;

class ScanRoutesCommand extends Command
{
    /**
     * Le nom et la signature de la commande.
     *
     * @var string
     */
    protected $signature = 'app:scan-routes';

    /**
     * Description de la commande.
     *
     * @var string
     */
    protected $description = 'Scanne toutes les routes Laravel et les enregistre dans la table features.';

    /**
     * Exécution de la commande.
     */
    public function handle()
    {
        $this->info('🔍 Scan des routes Laravel en cours...');

        $routes = Route::getRoutes();
        $count = 0;

        foreach ($routes as $route) {
            $name = $route->getName();
            $uri = $route->uri();
            $methods = implode(',', $route->methods());
            $prefix = $route->getPrefix() ?? '';
            $action = $route->getActionName();

            // Si la route n’a pas de nom, on la saute (facultatif)
            if (!$name) {
                continue;
            }
            if (Str::startsWith($uri, '_')) continue;


            // Construire un slug unique
           $slug = 'route_' . str_replace(['.', '/'], '_', $route->getName());
            $slug = strtolower(trim($slug));


            // Enregistrer ou mettre à jour la feature
            Feature::updateOrCreate(
                ['slug' => $slug],
                [
                    'nom' => $name,
                    'type' => 'route',
                    'chemin_fichier' => "URI: {$uri}",
                    'description' => "Méthode(s): {$methods} | Contrôleur: {$action} | Préfixe: {$prefix}",
                    'entreprises_id' => null,
                ]
            );

            $this->line("✅ Route ajoutée : {$name} ({$uri})");
            $count++;
        }

        $this->info("🎉 Scan terminé : {$count} routes enregistrées !");
        Log::info("ScanRoutesCommand exécuté — {$count} routes enregistrées.");
    }
}

// $features = Feature::where('type', 'route')->get();

// foreach ($features as $feature) {
//     $normalized = strtolower(str_replace(['.', '/'], '_', $feature->slug));
//     if (!Str::startsWith($normalized, 'route_')) {
//         $normalized = 'route_' . $normalized;
//     }
//     $feature->update(['slug' => $normalized]);
// }
