<?php

namespace App\Services;

use App\Models\CreditAccount;

class CreditAccountService
{
    public function createCreditAccount(
        int $userId,
        string $issuer,
        string $name,
        string $type,
        int $creditLimit,
        float $interestRate,
        ?int $annualFee,
        ?string $benefits,
        ?string $notes
    ): CreditAccount {
        $creditAccount = new CreditAccount();
        $creditAccount->user_id = $userId;
        $creditAccount->issuer = $issuer;
        $creditAccount->name = $name;
        $creditAccount->type = $type;
        $creditAccount->credit_limit = $creditLimit;
        $creditAccount->interest_rate = $interestRate;
        $creditAccount->annual_fee = $annualFee;
        $creditAccount->benefits = $benefits;
        $creditAccount->notes = $notes;
        $creditAccount->save();

        return $creditAccount;
    }

    public function updateCreditAccount(
        CreditAccount $creditAccount,
        string $issuer,
        string $name,
        string $type,
        int $creditLimit,
        float $interestRate,
        ?int $annualFee,
        ?string $benefits,
        ?string $notes
    ): CreditAccount {
        $creditAccount->issuer = $issuer;
        $creditAccount->name = $name;
        $creditAccount->type = $type;
        $creditAccount->credit_limit = $creditLimit;
        $creditAccount->interest_rate = $interestRate;
        $creditAccount->annual_fee = $annualFee;
        $creditAccount->benefits = $benefits;
        $creditAccount->notes = $notes;
        $creditAccount->save();

        return $creditAccount;
    }

    public function deleteCreditAccount(CreditAccount $creditAccount): bool
    {
        return $creditAccount->delete();
    }
}
