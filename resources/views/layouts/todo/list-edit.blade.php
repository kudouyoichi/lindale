<!-- 模态窗按钮 -->
<h4 class="panel-title">
    <a class="my-tooltip" title="{{ trans('todo.todo-list') }}" data-toggle="modal" data-target="#editTodoList">
        <span class="glyphicon glyphicon-cog"></span>
    </a>
</h4>

<!-- 模态窗 -->
<div class="modal fade" id="editTodoList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="glyphicon glyphicon-remove-circle"></span>
                </button>
                <h4 class="modal-title" id="myModalLabel" align="left" style="color: #000000">{{ trans('todo.todo-list') }}</h4>
            </div>
            <div class="modal-body" align="left">

                <div class="row">
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                		@if($lists->count() !== 0)
                            <div class="table-responsive">
                                <table class="table table-hover" style="color: #000000">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('todo.list-title') }}</th>
                                        <th>{{ trans('todo.delete') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($lists as $list)
                                        <tr>
                                            <td>{{ $list->id }}</td>
                                            <td>{{ $list->title }}</td>
                                            <td>
                                                <form action="{{ url("project/$project->id/todo/list/delete/$list->id") }}" method="post" role="form">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        @else
                            <h4 style="color: #ff0000">{{ trans('todo.none-list') }}</h4>
                        @endif
                	</div>
                </div>

            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span> {{ trans('todo.cancel') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>