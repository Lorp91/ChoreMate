<?php

namespace App\Actions\Task;

use App\Models\Task;

class UpdateTaskAction
{
    public function handle(Task $task, array $data)
    {
        return $task->update($data);
    }
}
