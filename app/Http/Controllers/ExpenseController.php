<?php

namespace App\Http\Controllers;

use Inertia\Response;

class ExpenseController extends Controller
{
    public function index(): Response
    {
        return inertia('Expenses/Index');
    }
}
