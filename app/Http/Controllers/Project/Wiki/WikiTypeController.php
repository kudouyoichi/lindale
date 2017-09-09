<?php

namespace App\Http\Controllers\Project\Wiki;

use App\Contracts\Repositories\WikiRepositoryContract;
use App\Wiki\WikiType;
use App\Project\Project;
use Illuminate\Http\Request;
use App\Http\Requests\TypeRequest;
use App\Http\Controllers\Controller;

class WikiTypeController extends Controller
{
    /**
     * WIKI资源库.
     * @var WikiRepositoryContract
     */
    protected $wikiRepository;

    /**
     * 构造器
     * 通过DI获取资源库.
     *
     * WikiController constructor.
     * @param WikiRepositoryContract $wikiRepository
     */
    public function __construct(WikiRepositoryContract $wikiRepository)
    {
        $this->wikiRepository = $wikiRepository;
    }

    /**
     * 创建WIKI表单.
     *
     * @param Project $project
     * @return mixed
     */
    public function create(Project $project)
    {
        return view('project.wiki.index', $this->wikiRepository->wikiResources($project))
            ->with(['project' => $project, 'selected' => 'wiki', 'add_wiki_index' => 'on']);
    }

    /**
     * 创建WIKI.
     *
     * @param TypeRequest $request
     * @param Project $project
     * @return mixed
     */
    public function store(TypeRequest $request, Project $project)
    {
        $result = $this->wikiRepository->createWikiType($request, $project)->save();

        return response()->save($result);
    }

    /**
     * 更新WIKI表单.
     *
     * @param Request $request
     * @param WikiType $wikiType
     * @return mixed
     */
    public function update(Request $request, Project $project, WikiType $wikiType)
    {
        // TODO: 認可
        $result = $this->wikiRepository->updateWikiType($request, $wikiType)->update();

        return response()->update($result);
    }

    /**
     * 删除WIKI表单.
     *
     * @param Project $project
     * @param WikiType $wikiType
     * @return mixed
     */
    public function destroy(Project $project, WikiType $wikiType)
    {
        $wikiType->Wikis()->delete();

        if ($wikiType->delete()) {
            return redirect()->to("/project/$project->id/wiki")->with('status', trans('errors.update-succeed'));
        } else {
            return redirect()->back()->withErrors(trans('errors.update-failed'));
        }
    }
}
