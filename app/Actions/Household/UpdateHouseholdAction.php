<?php

namespace App\Actions\Household;

use App\Models\Household;

class UpdateHouseholdAction
{
    public function handle(Household $household, array $data): Household
    {
        $household->update($data);

        return $household->refresh();
    }
}
