<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\FeatureAccessService;
use Illuminate\Support\Facades\Auth;

class FilterFeatureContent
{
    protected FeatureAccessService $accessService;

    public function __construct(FeatureAccessService $accessService)
    {
        $this->accessService = $accessService;
    }

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // On ne modifie que les réponses HTML
        if ($response->headers->get('Content-Type') && 
            str_contains($response->headers->get('Content-Type'), 'text/html')) {

            $user = Auth::user();
            $content = $response->getContent();

            // Expression régulière : trouve tous les éléments avec data-feature="..."
            preg_match_all('/data-feature="([^"]+)"/', $content, $matches);

            if (!empty($matches[1])) {
                foreach ($matches[1] as $slug) {
                    $hasAccess = $this->accessService->canAccess($user, $slug);

                    // Si pas d'accès, on retire l'élément complet du DOM
                    if (!$hasAccess) {
                        // Masquer ou supprimer l'élément complet
                        // ⚠️ Cette regex retire le tag complet <div ...>...</div>
                        $pattern = '/<[^>]*data-feature="' . preg_quote($slug, '/') . '"[^>]*>.*?<\/[^>]+>/si';
                        $content = preg_replace($pattern, '', $content);
                    }
                }
            }

            $response->setContent($content);
        }

        return $response;
    }
}
