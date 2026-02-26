<?php

namespace App\Actions\Room;

use App\Models\Household;
use App\Models\Room;

class CreateRoomAction
{
    public function handle(array $data, Household $household): Room
    {
        return Room::create([
            'name' => $data['name'],
            'household_id' => $household->id,
        ]);
    }
}
