<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

class UnavailableFeatureController extends Controller
{
    /**
     * Respond predictably while the original controller source is restored.
     */
    public function show(): Response
    {
        abort(503, 'This feature is temporarily unavailable because its source controller is not included in this release.');
    }
}
