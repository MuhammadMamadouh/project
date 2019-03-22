@extends('adminlte::page')
@section('title', $title)
@section('content_header')
    <h1>{{$title}}</h1>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/prism.css')}} ">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/select2/dist/css/select2.min.css')}}">
@endsection
@section('content')

    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            {!! Form::open(['url' => aurl('news'), 'method'=> 'post', 'id'=> 'frm-insert', 'files'=>true]) !!}

            <div class="form-group has-feedback {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"
                       placeholder="Enter title">
                @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('content') ? 'has-error' : '' }}">
                <label for="content">Content</label>
                <textarea name="content" id="summary-ckeditor" name="summary-ckeditor" class="form-control"></textarea>
                @if ($errors->has('content'))
                    <span class="help-block">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('image') ? 'has-error' : '' }}">
                <label for="image">Main image</label>
                <input type="file" name="image" id="image" class="form-control">

                @if ($errors->has('image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('sub_images') ? 'has-error' : '' }}">
                <label for="sub_image">Sub images</label>
                <input type="file" name="sub_images[]" multiple id="sub_image" class="form-control">
                @if ($errors->has('sub_images'))
                    <span class="help-block">
                            <strong>{{ $errors->first('sub_images') }}</strong>
                        </span>
                @endif
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="form-control select2"
                            data-placeholder="Select a State"
                            style="width: 100%;">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                 <span class="help-block pull-left">
                    <strong id="add-error"></strong>
                </span>

                <button type="submit" class="btn btn-primary">Add</button>
                {!! Form::close() !!}
                <a href="{{redirect()->back()}}" type="button" class="btn btn-info" data-dismiss="modal">cancel</a>
            </div>
        </div>
        <!-- /.box-body -->
    </div>


@endsection
@section('js')

    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
            CKEDITOR.replace('summary-ckeditor');
        });
    </script>
    <script src="{{ asset('js/prism.js')}}"></script>
    <script src="{{ asset('vendor/adminlte/plugins/select2/dist/js/select2.full.min.js') }}"></script>
@endsection
