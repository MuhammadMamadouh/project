@extends('adminlte::page')
@section('title', $title)
@section('content_header')
    <h1>{{$title}}</h1>
@stop
@section('content')

   
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">

            {!! Form::open(['url'=>aurl('settings'),'method'=>'put', 'files'=>true]) !!}
            <div class="form-group">
                {!! Form::label('sitename_ar','admin.sitename_ar') !!}
                {!! Form::text('sitename_ar',setting()->sitename,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email','admin.email') !!}
                {!! Form::email('email',setting()->email,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('logo','admin.logo') !!}
                {!! Form::file('logo',['class'=>'form-control']) !!}
                @if(!empty(setting()->logo))
                    <img src="{{ Storage::url(setting()->logo) }}" style="width:50px;height: 50px;" />
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('icon','admin.icon') !!}
                {!! Form::file('icon',['class'=>'form-control']) !!}

                @if(!empty(setting()->icon))
                    <img src="{{ Storage::url(setting()->icon) }}" style="width:50px;height: 50px;" />
                @endif

            </div>
            <div class="form-group">
                {!! Form::label('description','admin.description') !!}
                {!! Form::textarea('description',setting()->description,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('keywords','admin.keywords') !!}
                {!! Form::textarea('keywords',setting()->keywords,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('status','admin.status') !!}
                {!! Form::select('status',['open'=>'open','close'=>'close'],setting()->status,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('message_maintenance','admin.message_maintenance') !!}
                {!! Form::textarea('message_maintenance',setting()->message_maintenance,['class'=>'form-control']) !!}
            </div>
            {!! Form::submit('save',['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>

@endsection
