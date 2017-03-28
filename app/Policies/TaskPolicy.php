<?php

namespace App\Policies;

use Admin;
use App\User;
use App\Task\Task;
use App\Project\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * 删除任务的授权策略.
     *
     * @param Project $project
     * @param Task $task
     * @return bool
     */
    public function delete(User $user, Task $task, Project $project)
    {
        if ($user->id === $project->user_id) {
            return true;
        } elseif ($user->id === $project->sl_id) {
            return true;
        } elseif ($user->id === $task->user_id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Super Admin.
     *
     * @param User $user
     * @return bool
     */
    public function before(User $user)
    {
        if (Admin::is_super_admin($user)) {
            return true;
        }
    }
}
