<?php

namespace App\Http\Controllers;

use App\Http\Resources\BillResource;
use App\Http\Resources\BudgetResource;
use App\Http\Resources\SavingResource;
use App\Models\Bill;
use App\Models\Budget;
use App\Models\Saving;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Index', [
            'expenses' => [
                'budgets' => BudgetResource::collection(
                    Budget::where('user_id', Auth::user()->id)
                        ->orderBy('updated_at', 'desc')
                        ->get()
                ),
                'bills' => BillResource::collection(
                    Bill::where('user_id', Auth::user()->id)
                        ->orderBy('is_payed', 'asc')
                        ->get()
                ),
                'savings' => SavingResource::collection(
                    Saving::where('user_id', Auth::user()->id)
                        ->orderBy('is_payed', 'asc')
                        ->get()
                ),
            ],
        ]);
    }
}
