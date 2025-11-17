<?php

namespace App\Services;

use Dompdf\Dompdf;

class TestReprotService
{
    protected array $results = [];

    /**
     * Ajouter un resultat de test
     */

    public function addResult(string $testName, bool $status, string $message = '0', string $screenshotPath = '')
    {
        $this->results[] = [
            'test' => $testName,
            'status' => $status ? 'Succès ✅' : 'Échec ❌',
            'message' => $message,
            'screenshot' => $screenshotPath,
        ];
    }

    /**
     * Generer le rapport
     */

    public function generatePdf(string $filePath = null)
    {
        $filePath = $filePath ?? storage_path('app/reports/rapport_test.pdf');
        $directory = dirname($filePath);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $html = "<h1>Rapport de campagne de tests Dusk</h1><hr/>";

        foreach ($this->results as $result) {
            $html .= "<h3>{$result['test']}</h3>";
            $html .= "<p>Résultat : {$result['status']}</p>";
            if (!empty($result['message'])) {
                $html .= "<p>Détails : {$result['message']}</p>";
            }
            $html .= "<hr/>";
        }

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();

        file_put_contents($filePath, $dompdf->output());
    }
}