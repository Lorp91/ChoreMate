<?php

namespace App\Actions\Household;

use App\Models\Household;

class DeleteHouseholdAction
{
    public function handle(Household $household): void
    {
        $household->delete();
    }
}
