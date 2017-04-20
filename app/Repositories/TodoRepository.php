<?php

namespace App\Repositories;

use App\User;
use App\Definer;
use App\Todo\Todo;
use App\Todo\TodoList;
use App\Todo\TodoType;
use App\Project\Project;
use App\Todo\TodoStatus;
use App\Http\Requests\TodoRequest;
use App\Http\Requests\TypeRequest;

class TodoRepository
{
    /**
     * 获取项目To-do资源.
     *
     * @param Project|null $project
     * @param $type
     * @param TodoList|null $list
     * @param null $status
     * @param int $size
     * @param User|null $user
     * @return array
     */
    public function TodoResources(Project $project = null, TodoType $type = null, TodoList $list = null, $status = null, $size = Definer::TODO_PAGE_SIZE, User $user = null)
    {
        $todos = null;

        if ($project == null and $user == null) {
            abort(404);
        }

        if ($project != null) {
            $todos = $project->Todos();
        }

        if ($user != null) {
            $todos = $user->Todos();
        }

        if ($type != null) {
            if ((int) $type->id === Definer::PUBLIC_TODO) {
                $todos = $todos->where('type_id', $type->id);
            }

            if ((int) $type->id === Definer::PRIVATE_TODO) {
                $todos = $todos->where('type_id', $type->id);
            }
        }

        if ($list != null) {
            $todos = $todos->where('list_id', $list->id);
        }

        if ($status != null) {
            $todos = $todos->where('status_id', $status);
        }

        if ($project != null) {
            $lists = $project->TodoLists()->where('type_id', Definer::PUBLIC_TODO)->get();
        }

        if ($user != null) {
            $lists = $user->TodoLists()->where('type_id', Definer::PRIVATE_TODO)->get();
        }

        if ($user != null and $type != null) {
            if ((int) $type->id === Definer::PUBLIC_TODO) {
                $projects = $this->UserTodoProjects($user);
                if ($project != null) {
                    $todos = $todos->where('project_id', $project->id);
                }
            }
        }

        $todos = $todos->orderBy('status_id', 'desc')->latest('updated_at')->paginate($size);

        $statuses = TodoStatus::where('user_id', Definer::SUPER_ADMIN_ID)->get();

        return compact('todos', 'lists', 'statuses', 'projects');
    }

    public function AllTodoTypes()
    {
        $types = TodoType::all();

        return compact('types');
    }

    /**
     * 创建To-do方法.
     *
     * @param TodoRequest $request
     * @param Project|null $project
     * @return Todo
     */
    public function CreateTodo(TodoRequest $request, Project $project = null)
    {
        $todo = new Todo();

        $input = $request->only(['content', 'details', 'user_id', 'color_id', 'list_id', 'type_id', 'project_id']);

        foreach ($input as $key => $value) {
            if ($value == '') {
                continue;
            }
            $todo->$key = $value;
        }

        if ($project !== null) {
            $todo->type_id = Definer::PUBLIC_TODO;
            $todo->project_id = $project->id;
        } else {
            $todo->user_id = $request->user()->id;
        }

        $todo->status_id = Definer::UNDERWAY_STATUS_ID;
        $todo->initiator_id = $request->user()->id;

        return $todo;
    }

    /**
     * 更新To-do方法.
     *
     * @param TodoRequest $request
     * @param Todo $todo
     * @return Todo
     */
    public function UpdateTodo(TodoRequest $request, Todo $todo)
    {
        $input = $request->only(['content', 'details', 'user_id', 'color_id', 'list_id', 'status_id']);

        foreach ($input as $key => $value) {
            if ($value == '') {
                continue;
            }
            $todo->$key = $value;
        }

        return $todo;
    }

    /**
     * 创建To-do列表方法.
     *
     * @param TypeRequest $request
     * @param Project|null $project
     * @param User|null $user
     * @return TodoList
     */
    public function CreateTodoList(TypeRequest $request, Project $project = null, User $user = null)
    {
        $todoList = new TodoList();

        $todoList->title = $request->get('type_name');

        if ($project !== null) {
            $todoList->project_id = $project->id;
            $todoList->type_id = Definer::PUBLIC_TODO;
        }

        if ($user !== null) {
            $todoList->user_id = $user->id;
            $todoList->type_id = Definer::PRIVATE_TODO;
        }

        return $todoList;
    }

    /**
     * 获取用户To-do对应的项目列表.
     *
     * @param User $user
     * @return array
     */
    private function UserTodoProjects(User $user)
    {
        $projects = [];
        $todos = $user->Todos()->get();
        foreach ($todos as $todo) {
            $todoProjects = $todo->Project()->get();
            foreach ($todoProjects as $project) {
                if (isset($projects[$project->id]) != $project) {
                    $projects[$project->id] = $project;
                }
            }
        }

        return $projects;
    }
}
