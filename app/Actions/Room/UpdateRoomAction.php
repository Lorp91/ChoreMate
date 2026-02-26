<?php

namespace App\Actions\Room;

use App\Models\Room;

class UpdateRoomAction
{
    public function handle(Room $room, array $data)
    {
        return $room->update($data);
    }
}
