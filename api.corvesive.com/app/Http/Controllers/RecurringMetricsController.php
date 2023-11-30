<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecurringMetricsResource;
use App\Objects\RecurringMetricsObject;
use App\Repositories\RecurringMetricsRepository;

class RecurringMetricsController
{
    public function __invoke(): RecurringMetricsResource
    {
        $repository = new RecurringMetricsRepository(auth()->user());

        return new RecurringMetricsResource(
            new RecurringMetricsObject(
                $repository->getPaystubsTotal(),
                $repository->getBillsTotal(),
                $repository->getBudgetsTotal(),
                $repository->getSavingsTotal()
            )
        );
    }
}
