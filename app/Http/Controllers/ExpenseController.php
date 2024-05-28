<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Repositories\ExpenseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
                'nextMonth' => $repository->nextMonth(),
            ],
        ]);
    }

    public function create(Request $request): Response
    {
        return inertia('Expenses/Create');
    }

    public function show(Expense $expense): Response
    {
        Gate::authorize('isOwner', $expense);

        return inertia('Expenses/Show', [
            'expense' => $expense,
        ]);
    }
}
