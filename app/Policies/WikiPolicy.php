<?php

namespace App\Policies;

use Admin;
use App\User;
use App\Wiki\Wiki;
use App\Project\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class WikiPolicy
{
    use HandlesAuthorization;

    /**
     * create.
     * @param User $user
     * @param Wiki $wiki
     * @param Project $project
     * @return bool
     */
    public function create(User $user, Wiki $wiki, Project $project)
    {
        if (($user->id === $project->user_id) and ($project->id === $wiki->project_id)) {
            return true;
        } elseif (($user->id === $project->sl_id) and ($project->id === $wiki->project_id)) {
            return true;
        } elseif (($project->Users()->find($user->id)) and ($project->id === $wiki->project_id)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * update.
     * @param User $user
     * @param Wiki $wiki
     * @param Project $project
     * @return bool
     */
    public function update(User $user, Wiki $wiki, Project $project)
    {
        if (($user->id === $project->user_id) and ($project->id === $wiki->project_id)) {
            return true;
        } elseif (($user->id === $project->sl_id) and ($project->id === $wiki->project_id)) {
            return true;
        } elseif (($project->Users()->find($user->id)) and ($project->id === $wiki->project_id)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * show.
     * @param User $user
     * @param Wiki $wiki
     * @param Project $project
     * @return bool
     */
    public function show(User $user, Wiki $wiki, Project $project)
    {
        if (($user->id === $project->user_id) and ($project->id === $wiki->project_id)) {
            return true;
        } elseif (($user->id === $project->sl_id) and ($project->id === $wiki->project_id)) {
            return true;
        } elseif (($project->Users()->find($user->id)) and ($project->id === $wiki->project_id)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * delete.
     * @param User $user
     * @param Wiki $wiki
     * @param Project $project
     * @return bool
     */
    public function delete(User $user, Wiki $wiki, Project $project)
    {
        if (($user->id === $project->user_id) and ($project->id === $wiki->project_id)) {
            return true;
        } elseif (($user->id === $project->sl_id) and ($project->id === $wiki->project_id)) {
            return true;
        } elseif (($project->Users()->find($user->id)->pivot->is_admin === config('admin.project_admin')) and ($project->id === $wiki->project_id)) {
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
