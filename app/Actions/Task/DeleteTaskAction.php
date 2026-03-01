<?php

namespace App\Actions\Task;

use App\Models\Task;

class DeleteTaskAction
{
    public function handle(Task $task)
    {
        return $task->delete();
    }
}
