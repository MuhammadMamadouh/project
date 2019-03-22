@extends('adminlte::page')
@section('content')<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Category</h4>
    </div>

    <div class="modal-body">
        {!! Form::open(['route' => ['categories.update', $id], 'method'=> 'put','id'=>'frm-update-'.$id]) !!}
        <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">

            <input type="text" name="name" class="form-control input" value="{{$name}}"
                   placeholder="full name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="modal-footer">
                <span class="help-block pull-left">
                    <strong id="edit-error"></strong>
                </span>

            <button type="submit" class="btn btn-primary">update</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
