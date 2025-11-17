<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\Feature;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ScanFeaturesCommand extends Command
{
    /**
     * Le nom et la signature de la commande
     *
     * @var string
     */
    protected $signature = 'app:scan-features 
                            {--path=resources/views : Dossier à scanner (par défaut resources/views)}';

    /**
     * Description de la commande
     *
     * @var string
     */
    protected $description = 'Scanne les fichiers Blade et enregistre toutes les features (data-feature="...") dans la base de données';

    /**
     * Exécution de la commande
     */
    public function handle()
    {
        $directory = base_path($this->option('path'));
        $this->info("🔍 Scan du dossier : {$directory}");

        if (!File::exists($directory)) {
            $this->error("❌ Le dossier spécifié n'existe pas.");
            return;
        }

        $files = File::allFiles($directory);
        $count = 0;

        foreach ($files as $file) {
            if (!Str::endsWith($file->getFilename(), '.blade.php')) {
                continue; // On ne lit que les fichiers Blade
            }

            $content = File::get($file->getRealPath());

            // Rechercher toutes les occurrences de data-feature="..."
            preg_match_all('/data-feature="([^"]+)"/', $content, $matches);

            if (empty($matches[1])) {
                continue;
            }

            foreach ($matches[1] as $slug) {
                $slug = trim($slug);
                $type = $this->detectType($slug);
                $relativePath = str_replace(base_path() . '/', '', $file->getRealPath());

                // Enregistrement ou mise à jour
                Feature::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'nom' => ucfirst(str_replace('_', ' ', $slug)),
                        'type' => $type,
                        'chemin_fichier' => $relativePath,
                        'description' => "Feature détectée automatiquement dans {$relativePath}",
                        'entreprises_id' => null,
                    ]
                );

                $this->line("✅ Enregistré : {$slug} ({$type})");
                $count++;
            }
        }

        $this->info("🎉 Scan terminé : {$count} features détectées et enregistrées !");
        Log::info("ScanFeaturesCommand exécuté — {$count} features enregistrées.");
    }

    /**
     * Détecte automatiquement le type de feature selon son nom
     */
    protected function detectType(string $slug): string
    {
        if (Str::contains($slug, ['menu', 'nav'])) return 'section';
        if (Str::contains($slug, ['section', 'card'])) return 'section';
        if (Str::contains($slug, ['btn', 'button'])) return 'button';
        return 'section'; // par défaut
    }
}
