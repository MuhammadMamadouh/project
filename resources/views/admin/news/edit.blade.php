@extends('adminlte::page')
@section('content')
    <div class="modal-content">
        <div class="modal-header">

            <h4 class="modal-title">Edit News</h4>
        </div>

        <div class="modal-body">
            {!! Form::open(['route' => ['news.update', $news->id], 'method'=> 'put', 'files'=>true]) !!}
            <div class="form-group has-feedback {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{$news->title }}"
                       placeholder="Enter title">
                @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('content') ? 'has-error' : '' }}">
                <label for="content">Content</label>
                <textarea name="content" id="summary-ckeditor" name="summary-ckeditor"
                          class="form-control">{!! $news->content !!}</textarea>
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
            <div class="form-group has-feedback {{ $errors->has('category_id') ? 'has-error' : '' }}">
                <label>Category</label>
                <select name="category_id" class="form-control select2"
                        data-placeholder="Select a State"
                        style="width: 100%;">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"
                                @if($news->category_id === $category->id) selected @endif
                        >{{$category->name}}</option>
                    @endforeach
                </select>
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

