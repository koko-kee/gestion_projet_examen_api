<?php

use App\Models\Tache;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('assign-task.{id}', function ($user, $taskId) {
    $task = Tache::find($taskId);
    return $task && $user->id === $task->id_assigne;
});
