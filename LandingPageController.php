<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class LandingPageController extends Controller
{
    /**
     * Exibe a landing page pública
     */
    public function index(): Response
    {
        return Inertia::render('LandingPage/Index');
    }
}

