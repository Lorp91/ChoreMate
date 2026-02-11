@props(['task'])

<div class="card bg-base-100 max-w-5xl shadow-sm">
    <div class="card-body">
        <div class="flex flex-row items-center">
            <input type="checkbox" class="checkbox mr-3"/>
            <h2 class="text-xl">{{ $task->title }}</h2>
        </div>
        <div class="text-base-content/30">
            <span>{{ $task->room->name }}</span>
            <span>{{ optional($task->due_date)->diffForHumans() }}</span>
        </div>
    </div>
</div>
