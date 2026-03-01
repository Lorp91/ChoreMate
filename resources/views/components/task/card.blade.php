@props(['task'])

@php
    use Carbon\Carbon;

    $today = Carbon::today();
@endphp

<div class="bg-base-100 shadow-sm max-w-5xl card">
    <div class="flex flex-row card-body">
        <div class="flex flex-col justify-between">
            <div>
                <h2 class="text-xl"><a href="{{ route('tasks.edit', $task) }}">{{ $task->title }}</a></h2>
            </div>
            <div class="text-base-content/40">
                <span>{{ $task->room->name }}</span>
                <span @class([
                    'text-error' => $task->due_date && $task->due_date < $today,
                    'text-accent' => $task->due_date && $task->due_date->isToday(),
                    'text-warning' => $task->due_date && $task->due_date > $today,
                ])>
                    @php
                        $days = optional($task->due_date)->diffInDays($today, false);
                    @endphp

                    @if ($task->due_date && $task->due_date->isToday())
                        Heute
                    @elseif ($days < 0)
                        in {{ abs($days) }} Tag{{ abs($days) > 1 ? 'en' : '' }}
                    @else
                        vor {{ abs($days) }} Tag{{ abs($days) > 1 ? 'en' : '' }}
                    @endif
                </span>
            </div>
        </div>
        <div class="flex items-center ml-auto">
            <form method="POST" action="{{ route('tasks.complete', $task) }}">
                @csrf
                @method('PATCH')

                <button type="submit" class="btn btn-primary">Done</button>
            </form>
        </div>
    </div>
</div>
