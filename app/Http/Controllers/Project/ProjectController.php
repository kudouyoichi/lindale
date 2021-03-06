<?php

namespace App\Http\Controllers\Project;

use App\Contracts\Repositories\ProjectRepositoryContract;
use App\Project\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Events\Project\ProjectCreated;
use App\Events\Project\ProjectDeleted;
use App\Events\Project\ProjectUpdated;

class ProjectController extends Controller
{
    /**
     * 项目资源库.
     * @var ProjectRepositoryContract
     */
    protected $projectRepository;

    /**
     * 构造器
     * 通过DI获取项目资源库.
     *
     * ProjectController constructor.
     * @param ProjectRepositoryContract $projectRepository
     */
    public function __construct(ProjectRepositoryContract $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * 项目一览.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('project.index', $this->projectRepository->ProjectResources('projects'));
    }

    /**
     * 未完成项目一览.
     *
     * @return \Illuminate\Http\Response
     */
    public function unfinished()
    {
        return view('project.index', $this->projectRepository->ProjectResources('unfinished'));
    }

    /**
     * 已完成项目一览.
     *
     * @return \Illuminate\Http\Response
     */
    public function finished()
    {
        return view('project.index', $this->projectRepository->ProjectResources('finished'));
    }

    /**
     * 创建项目的表单.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.create', $this->projectRepository->ProjectResources());
    }

    /**
     * 创建项目.
     *
     * @param ProjectRequest $request
     * @return mixed
     */
    public function store(ProjectRequest $request)
    {
        if ($this->projectRepository->CreateProject($request)->save()) {
            return redirect()->to('/project')->with('status', trans('errors.save-succeed'));
        } else {
            return redirect()->back()->withErrors(trans('errors.save-fail'));
        }
    }

    /**
     * 项目首页.
     *
     * @param Project $project
     * @return mixed
     */
    public function show(Project $project)
    {
        return view('project.show', $this->projectRepository->ProjectTopResources($project))
            ->with('project', $project)
            ->with(['selected' => 'top']);
    }

    /**
     * 编辑项目的表单.
     *
     * @param Project $project
     * @return mixed
     */
    public function edit(Project $project)
    {
        return view('project.edit', $this->projectRepository->ProjectResources())->with('project', $project);
    }

    /**
     * 更新项目.
     *
     * @param ProjectRequest $request
     * @param Project $project
     * @return mixed
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $this->authorize('update', [$project, $request]);

        if ($this->projectRepository->UpdateProject($request, $project)->update()) {
            return redirect()->to(route('config.index', compact('project')))->with('status', trans('errors.update-succeed'));
        } else {
            return redirect()->back()->withErrors(trans('errors.update-failed'));
        }
    }

    /**
     * 删除项目.
     *
     * @param ProjectRequest $request
     * @param Project $project
     * @return mixed
     */
    public function destroy(ProjectRequest $request, Project $project)
    {
        $this->authorize('delete', [$project, $request]);

        if ($project->delete()) {
            return redirect()->to('/project')->with('status', trans('errors.delete-succeed'));
        } else {
            return redirect()->back()->withErrors(trans('errors.delete-failed'));
        }
    }

    /**
     * 譲渡
     * @param Request $request
     * @param Project $project
     * @return mixed
     */
    public function transfer(Request $request, Project $project)
    {
        $this->authorize('delete', [$project, $request]);

        if ($this->projectRepository->Transfer($request, $project)->update()) {
            return redirect()->to('/project')->with('status', trans('errors.update-succeed'));
        } else {
            return redirect()->back()->withErrors(trans('errors.update-failed'));
        }
    }
}
