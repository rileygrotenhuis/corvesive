<?php

namespace App\Objects;

class ExpenseBanner
{
    public function __construct(
        public string $id,
        public string $type,
        public ?string $issuer,
        public string $name,
        public int $amount,
        public string $date,
        public ?string $monthYear,
        public bool $isPaid,
        public ?string $notes = null
    ) {
        //
    }
}
