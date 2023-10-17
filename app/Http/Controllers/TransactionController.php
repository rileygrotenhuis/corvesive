<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;

class TransactionController extends Controller
{
    public function store(): TransactionResource
    {
        return new TransactionResource([]);
    }
}
