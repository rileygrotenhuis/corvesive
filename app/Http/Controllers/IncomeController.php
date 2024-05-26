<?php

namespace App\Http\Controllers;

use Inertia\Response;

class IncomeController extends Controller
{
    public function index(): Response
    {
        return inertia('Income/Index');
    }
}
