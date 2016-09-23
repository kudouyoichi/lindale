<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="right">
        <a href="{{ url("project/$project->id/member/create") }}" class="btn btn-link my-tooltip" title="{{ trans('wiki.submit') }}">
            <h4 class="text-success"><span class="glyphicon glyphicon-plus"></span></h4>
        </a>
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-default">查看方式： 列表</button>
            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
            </ul>
        </div>
    </div>
</div>