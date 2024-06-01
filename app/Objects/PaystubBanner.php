<?php

namespace App\Objects;

class PaystubBanner
{
    public function __construct(
        public string $id,
        public string $issuer,
        public string $recurrence,
        public int $amount,
        public ?string $date,
        public ?string $monthYear,
        public bool $isDeposited,
        public ?string $notes = null
    ) {
        //
    }
}
