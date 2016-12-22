<!-- 模态窗按钮 -->
<a class="text-danger" data-toggle="modal" data-target="#deleteModel{{ $model->id }}">
    <span class="glyphicon glyphicon glyphicon-trash"></span> {{ trans('task.delete') }}
</a>

<!-- 模态窗 -->
<div class="modal fade" id="deleteModel{{ $model->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="glyphicon glyphicon-remove-circle"></span>
                </button>
                <h4 class="modal-title" id="myModalLabel" align="left" style="color: #000000">{{ trans('task.delete') }}</h4>
            </div>
            <form action="{{ $delete_url }}" method="POST" style="display: inline;">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}

                <div class="modal-body" align="left" style="color: #000000">

                    <div class="row">
                    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    		<h4 class="text-danger">
                                #{{ $model->id }}{{ $model->title }}&nbsp;&nbsp;{{ trans('task.delete-title') }}
                            </h4>
                    	</div>
                    </div>

                </div>

                <div class="modal-footer" style="color: #000000">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span> {{ trans('task.cancel') }}
                            </button>
                            <button type="submit" class="btn btn-danger">
                                <span class="glyphicon glyphicon glyphicon-trash"></span> {{ trans('task.delete') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>