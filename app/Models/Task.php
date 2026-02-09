<?php

namespace App\Models;

use App\Enums\IntervalUnit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

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

    protected $casts = [
        'due_date' => 'datetime',
        'repeat_interval' => 'integer',
        'interval_unit' => IntervalUnit::class,
    ];

    // relations

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function completedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'completed_tasks')
            ->using(CompletedTask::class)
            ->withPivot(['completed_at'])
            ->withTimestamps();
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function completions(): HasMany
    {
        return $this->hasMany(CompletedTask::class);
    }

    // logic

    public function complete(User $user)
    {
        return DB::transaction(function () use ($user) {
            $completion = $this->completions()->create([
                'user_id' => $user->id,
                'completed_at' => now(),
            ]);

            if ($this->repeat_interval && $this->interval_unit) {
                $this->setNextDueDate();
            }

            return $completion;
        });
    }

    private function setNextDueDate()
    {
        $dueDate = $this->due_date->copy();

        $next = match ($this->interval_unit) {
            IntervalUnit::DAY => $dueDate->addDays($this->repeat_interval),
            IntervalUnit::WEEK => $dueDate->addWeeks($this->repeat_interval),
            IntervalUnit::MONTH => $dueDate->addMonths($this->repeat_interval),
            IntervalUnit::YEAR => $dueDate->addYears($this->repeat_interval),
        };

        $this->update(['due_date' => $next]);
    }
}
