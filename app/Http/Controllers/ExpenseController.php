<?php

namespace App\Http\Controllers;

use App\Repositories\ExpenseRepository;
use Illuminate\Http\Request;
use Inertia\Response;

class ExpenseController extends Controller
{
    public function index(Request $request): Response
    {
        $repository = new ExpenseRepository($request->user());

        return inertia('Expenses/Index', [
            'expenses' => [
                'all' => $repository->all(),
                'upcoming' => $repository->upcoming(),
                'thisMonth' => $repository->thisMonth(),
                'nextMonth' => $repository->nextMonth()
            ]
        ]);
    }
}
