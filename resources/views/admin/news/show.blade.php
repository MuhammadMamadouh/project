@extends('adminlte::page')
@section('title', $title)
@section('content_header')
    <h1>{{$title}}</h1>
@stop
@section('content')

    <div class="box">
        <div class="box-body">
            <a href="{{aurl("news/create")}}" class="btn btn-primary pull-right">create</a>
            <a href="{{aurl("news/$news->id/edit")}}" class="btn btn-info pull-right">Edit</a>
            <!-- Trigger the modal with a button -->
            <a class="btn btn-danger pull-right" data-toggle="modal" data-target="#delete_modal{{ $news->id }}"
               data-id="{{$news->id}}" id="delete"> Delete
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
                        @if($column === 'content')
                            {!!$news->$column !!}
                        @elseif($column === 'image')
                            <img class="img-responsive" src="{{\Storage::url($news->$column)}}">
                        @elseif($column === 'sub_images')
                            @foreach(json_decode($news->sub_images) as $image)
                                <img class="img-thumbnail" style="width: 100px" height="100px"
                                     src="{{\Storage::url($image)}}">
                            @endforeach

                        @elseif($column === 'category_id')
                            <a href="{{aurl('categories/' . $news->category->id)}}">{{$news->category->name}}</a>
                        @else
                            {{$news->$column}}
                        @endif
                    </div>
                </div>

            @endforeach
        </div>
        <!-- /.box-body -->
    </div>
    <div id="delete_modal{{ $news->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete News</h4>
                </div>
                {!! Form::open(['route'=>['news.destroy',$news->id],'method'=>'delete', 'id'=> 'frm-delete-'.$news->id]) !!}
                <div class="modal-body">
                    <h4>You Want to delete {{$news->title}} ?</h4>
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
