<?php

namespace App\Services;

use App\Models\PayPeriod;
use App\Models\PayPeriodMetric;
use App\Objects\PayPeriodMetricsObject;
use App\Repositories\PayPeriodMetricsRepository;

class PayPeriodMetricService
{
    public function savePayPeriodMetrics($payPeriod): PayPeriodMetric
    {
        $payPeriodMetricsRepository = new PayPeriodMetricsRepository($payPeriod);

        $payPeriodMetricsFormatted = new PayPeriodMetricsObject(
            auth()->user()->id,
            $payPeriod->id,
            $payPeriodMetricsRepository->getBillMetrics(),
            $payPeriodMetricsRepository->getBudgetMetrics(),
            $payPeriodMetricsRepository->getIncomeMetrics(),
            $payPeriodMetricsRepository->getTransactionMetrics()
        );

        $payPeriodMetric = $this->findOrCreateNewPayPeriodMetric($payPeriod);
        $payPeriodMetric = $this->attachBillMetrics($payPeriodMetric, $payPeriodMetricsFormatted);
        $payPeriodMetric = $this->attachBudgetMetrics($payPeriodMetric, $payPeriodMetricsFormatted);
        $payPeriodMetric = $this->attachIncomeMetrics($payPeriodMetric, $payPeriodMetricsFormatted);
        $payPeriodMetric = $this->attachTransactionMetrics($payPeriodMetric, $payPeriodMetricsFormatted);
        $payPeriodMetric = $this->attachSurplusMetrics($payPeriodMetric, $payPeriodMetricsFormatted);
        $payPeriodMetric->save();

        return $payPeriodMetric;
    }

    protected function findOrCreateNewPayPeriodMetric(PayPeriod $payPeriod): PayPeriodMetric
    {
        $payPeriodMetric = PayPeriodMetric::where('user_id', auth()->user()->id)
            ->where('pay_period_id', $payPeriod->id)
            ->first();

        if (! $payPeriodMetric) {
            $payPeriodMetric = new PayPeriodMetric();
            $payPeriodMetric->user_id = auth()->user()->id;
            $payPeriodMetric->pay_period_id = $payPeriod->id;
        }

        return $payPeriodMetric;
    }

    protected function attachBillMetrics(
        PayPeriodMetric $payPeriodMetric,
        PayPeriodMetricsObject $payPeriodMetricsFormatted
    ): PayPeriodMetric {
        $payPeriodMetric->bills_total_payed = $payPeriodMetricsFormatted->bills_total_payed;
        $payPeriodMetric->bills_total_unpayed = $payPeriodMetricsFormatted->bills_total_unpayed;
        $payPeriodMetric->bills_total = $payPeriodMetricsFormatted->bills_total;

        return $payPeriodMetric;
    }

    protected function attachBudgetMetrics(
        PayPeriodMetric $payPeriodMetric,
        PayPeriodMetricsObject $payPeriodMetricsFormatted
    ): PayPeriodMetric {
        $payPeriodMetric->budgets_total_balance = $payPeriodMetricsFormatted->budgets_total_balance;
        $payPeriodMetric->budgets_remaining_balance = $payPeriodMetricsFormatted->budgets_remaining_balance;

        return $payPeriodMetric;
    }

    protected function attachIncomeMetrics(
        PayPeriodMetric $payPeriodMetric,
        PayPeriodMetricsObject $payPeriodMetricsFormatted
    ): PayPeriodMetric {
        $payPeriodMetric->total_paystubs = $payPeriodMetricsFormatted->total_paystubs;
        $payPeriodMetric->total_income = $payPeriodMetricsFormatted->total_income;

        return $payPeriodMetric;
    }

    protected function attachTransactionMetrics(
        PayPeriodMetric $payPeriodMetric,
        PayPeriodMetricsObject $payPeriodMetricsFormatted
    ): PayPeriodMetric {
        $payPeriodMetric->bills_total_spent = $payPeriodMetricsFormatted->bills_total_spent;
        $payPeriodMetric->budgets_total_spent = $payPeriodMetricsFormatted->budgets_total_spent;
        $payPeriodMetric->total_spent = $payPeriodMetricsFormatted->total_spent;
        $payPeriodMetric->total_deposited = $payPeriodMetricsFormatted->total_deposited;

        return $payPeriodMetric;
    }

    protected function attachSurplusMetrics(
        PayPeriodMetric $payPeriodMetric,
        PayPeriodMetricsObject $payPeriodMetricsFormatted
    ): PayPeriodMetric {
        $payPeriodMetric->current_surplus = $payPeriodMetricsFormatted->current_surplus;
        $payPeriodMetric->projected_surplus = $payPeriodMetricsFormatted->projected_surplus;

        return $payPeriodMetric;
    }
}
