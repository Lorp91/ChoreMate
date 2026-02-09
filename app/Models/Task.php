<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'repeat_interval',
        'interval_unit',
        'room_id',
        'user_id',
    ];

    // relations

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }


    // logic

    public function completeTask()
    {
        // TODO: bauen ruft (wenn interval) setNext auf
        // TODO: erstellt completed_task mit now()
    }

    private function setNextDueDate()
    {
        // TODO: bauen macht due_date auf neues date mit carbon
    }
}
