<?php

namespace App\Http\Controllers\Project\Task;

use App\Http\Requests\TaskGroupRequest;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project\Project;

class TaskGroupController extends Controller
{
    /**
     * 任务资源库
     *
     * @var TaskRepository
     */
    protected $taskRepository;

    /**
     * 构造器
     * 注入资源
     *
     * TaskGroupController constructor.
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * 创建任务组
     *
     * @param Project $project
     * @return mixed
     */
    public function create(Project $project)
    {
        return view('project.task.group.create', $this->taskRepository->TaskGroupCreateResources($project))
            ->with(['project' => $project, 'selected' => 'tasks']);
    }

    /**
     * 保存任务组
     *
     * @param TaskGroupRequest $request
     * @param Project $project
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(TaskGroupRequest $request, Project $project)
    {
        $group = $this->taskRepository->CreateGroup($request, $project);

        $result = $group->save();

        if ($result) {
            return redirect()->to('project/'.$project->id.'/task')->with('status', trans('errors.save-succeed'));
        } else {
            return redirect()->back()->withErrors(trans('errors.save-failed'));
        }
    }
}
