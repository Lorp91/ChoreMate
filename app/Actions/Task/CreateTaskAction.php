<?php

namespace App\Actions\Task;

use App\Models\Room;
use App\Models\Task;

class CreateTaskAction
{
    public function handle(Room $room, array $data)
    {
        return Task::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'due_date' => $data['due_date'] ?? null,
            'repeat_interval' => $data['repeat_interval'] ?? null,
            'interval_unit' => $data['interval_unit'] ?? null,
            'room_id' => $room->id,
            'user_id' => $data['user_id'] ?? null,
        ]);
    }
}
