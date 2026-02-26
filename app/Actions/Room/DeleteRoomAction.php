<?php

namespace App\Actions\Room;

use App\Models\Room;

class DeleteRoomAction
{
    public function handle(Room $room)
    {
        $room->delete();
    }
}
