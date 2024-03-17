<?php

namespace App\Http\Controllers;

use App\Repositories\IncomeBreakdown;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IncomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $repository = new IncomeBreakdown($request->user());

        return Inertia::render('Income/Index', [
            'incomeBreakdown' => $repository->getIncomeBreakdown(),
        ]);
    }
}
