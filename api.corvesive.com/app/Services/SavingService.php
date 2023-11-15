<?php

namespace App\Services;

use App\Models\Saving;

//use App\Models\PayPeriodSaving;

class SavingService
{
    public function createSaving(
        int $userId,
        string $name,
        int $amount,
        ?string $notes
    ): Saving {
        $saving = new Saving();
        $saving->user_id = $userId;
        $saving->name = $name;
        $saving->amount = $amount;
        $saving->notes = $notes;
        $saving->save();

        return $saving;
    }

    public function updateSaving(
        Saving $saving,
        string $name,
        int $amount,
        ?string $notes
    ): Saving {
        $saving->name = $name;
        $saving->amount = $amount;
        $saving->notes = $notes;
        $saving->save();

        return $saving;
    }

    public function deleteSaving(Saving $saving): bool
    {
        //        $this->removeAttachedPayPeriodSavings($saving);

        return $saving->delete();
    }

    //    protected function removeAttachedPayPeriodSavings(Saving $saving): void
    //    {
    //        PayPeriodSaving::where('saving_id', $saving->id)->delete();
    //    }
}
