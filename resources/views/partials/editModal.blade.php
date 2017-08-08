<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Status</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PATCH', 'action'=> ['UserController@updateStatus', $user->id]]) !!}
                {!! Form::text('status', null, ['class'=>'form-control', 'placeholder'=>'Update your status in 100 characters or less!']) !!}
            </div>
            <div class="modal-footer">
                {!! Form::submit('Update Status', ['class'=>'btn btn-primary', 'style'=>'position:relative;right:230px;']) !!}
            </div>
            {!! Form::close() !!}
        </div>

    </div>
</div>
