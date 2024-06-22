<?php

namespace App\Objects;

class ExpenseBanner
{
    /**
     * This object represents the details required
     * for a single expense banner component.
     */
    public function __construct(
        public string $id,
        public string $type,
        public ?string $issuer,
        public string $name,
        public float $amount,
        public string $date,
        public ?string $monthYear,
        public bool $isPaid,
        public ?string $notes = null
    ) {
        //
    }
}
