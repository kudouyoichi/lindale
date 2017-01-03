<?php

namespace App\Http\Controllers\Project;

use App\Definer;
use App\Events\Todo\TodoCreated;
use App\Events\Todo\TodoDeleted;
use App\Events\Todo\TodoUpdated;
use App\Project\Project;
use App\Repositories\MemberRepository;
use App\Repositories\TodoRepository;
use App\Todo\Todo;
use App\Todo\TodoList;
use App\Http\Controllers\Controller;
use App\Http\Requests\TodoRequest;
use App\Todo\TodoType;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * To-do资源库.
     * @var TodoRepository
     */
    protected $todoRepository;
    /**
     * 项目成员资源库.
     * @var MemberRepository
     */
    protected $memberRepository;

    /**
     * 构造器
     * 通过DI注入资源库.
     *
     * TodoController constructor.
     * @param TodoRepository $todoRepository
     * @param MemberRepository $memberRepository
     */
    public function __construct(TodoRepository $todoRepository, MemberRepository $memberRepository)
    {
        $this->todoRepository = $todoRepository;
        $this->memberRepository = $memberRepository;
    }

    /**
     * Index.
     *
     * @param Project $project
     * @param null $status
     * @return mixed
     */
    public function index(Project $project, $status = null)
    {
        $type = TodoType::find(Definer::PUBLIC_TODO);

        return view('project.todo.index', $this->todoRepository->TodoResources($project, $type, null, $status))
            ->with($this->memberRepository->AllMember($project))
            ->with(['project' => $project, 'selected' => 'todo']);
    }

    /**
     * 创建To-do.
     *
     * @param TodoRequest $request
     * @param Project $project
     * @return mixed
     */
    public function store(TodoRequest $request, Project $project)
    {
        $todo = $this->todoRepository->CreateTodo($request, $project);
        $result = $todo->save();

        if ($result) {

            event(new TodoCreated($todo, $request->user()));

            return redirect()->back()->with('status', trans('errors.save-succeed'));
        } else {
            return redirect()->back()->withErrors(trans('errors.save-failed'));
        }
    }

    /**
     * 展示To-do(列表).
     *
     * @param Project $project
     * @param $list
     * @return mixed
     */
    public function show(Project $project, $list)
    {
        $list = TodoList::findOrFail($list);
        $type = TodoType::find(Definer::PUBLIC_TODO);

        return view('project.todo.index', $this->todoRepository->TodoResources($project, $type, $list))
            ->with($this->memberRepository->AllMember($project))
            ->with(['project' => $project, 'selected' => 'todo']);
    }

    /**
     * 更新To-do.
     *
     * @param TodoRequest $request
     * @param Project $project
     * @param Todo $todo
     * @return mixed
     */
    public function update(TodoRequest $request, Project $project, Todo $todo)
    {
        $this->authorize('update', [$todo, $project]);

        $result = $this->todoRepository->UpdateTodo($request, $todo)->update();

        if ($result) {

            event(new TodoUpdated($todo, $request->user()));

            return redirect()->back()->with('status', trans('errors.update-succeed'));
        } else {
            return redirect()->back()->withErrors(trans('errors.update-failed'));
        }
    }

    /**
     * 删除To-do.
     *
     * @param Project $project
     * @param Todo $todo
     * @return mixed
     */
    public function destroy(Project $project, Todo $todo, Request $request)
    {
        $this->authorize('delete', [$todo, $project]);

        if ($todo->delete()) {

            event(new TodoDeleted($todo, $request->user()));

            return redirect()->back()->with('status', trans('errors.delete-succeed'));
        } else {
            return redirect()->back()->withErrors(trans('errors.delete-failed'));
        }
    }
}
