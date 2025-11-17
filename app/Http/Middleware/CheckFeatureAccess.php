<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\FeatureAccessService;
use Illuminate\Support\Facades\Auth;

class CheckFeatureAccess
{
    protected FeatureAccessService $accessService;

    public function __construct(FeatureAccessService $accessService)
    {
        $this->accessService = $accessService;
    }

    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $routeName = $request->route()->getName();
        // dd($this->accessService->canAccessRoute($user, $routeName));

        if ($routeName && !$this->accessService->canAccessRoute($user, $routeName)) {
            abort(403, "🚫 Vous n'avez pas accès à cette ressource ({$routeName}).");
        }

        return $next($request);
    }
}
