@extends('adminlte::page')
@section('title', $title)
@section('content_header')
    <h1>{{$title}}</h1>
@stop
@section('content')

    <div class="box">
        <div class="box-body">
            <a href="{{aurl("categories/$category->id/edit")}}" class="btn btn-primary pull-right">Edit</a>
            <!-- Trigger the modal with a button -->
            <a class="btn btn-danger pull-right" data-toggle="modal" data-target="#delete_modal{{ $category->id }}" data-id="{{$category->id}}" id="delete"> Delete
                <i class="fa fa-trash"></i></a>
            
        </div>
    </div>
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            @foreach($columns as $column)

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{$column}}</h3>
                    </div>
                    <div class="panel-body">
                        {{$category->$column}}
                    </div>
                </div>

            @endforeach
        </div>
        <!-- /.box-body -->
    </div>
    <div id="delete_modal{{ $category->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Category</h4>
                </div>
                {!! Form::open(['route'=>['categories.destroy',$category->id],'method'=>'delete', 'id'=> 'frm-delete-'.$category->id]) !!}
                <div class="modal-body">
                    <h4>You Want to delete {{$category->name}} ?</h4>
                </div>
                <div class="modal-footer">
                 <span class="help-block pull-left">
                    <strong id="delete-error"></strong>
                </span>
                    <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                    {!! Form::submit('yes',['class'=>'btn btn-danger']) !!}
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>

@endsection
