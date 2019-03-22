@extends('adminlte::page')
@section('title', $title)
@section('content_header')
    <h1>{{$title}}</h1>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('content')


    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">

            <div class="container">
                <h2>{{$title}}</h2>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#news">News</a></li>
                    <li><a data-toggle="tab" href="#categories">Categories</a></li>

                </ul>

                <div class="tab-content">

                    <div id="categories" class="tab-pane fade">
                        <h3>Categories</h3>
                        <div class="box-body">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($categories as $item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->title}}</td>
                                                <td>{!!$item->content!!}</td>
                                                <td>
                                                    <a href="{{aurl("categories/$item->id")}}" id="show"
                                                       class="btn btn-info">Show</a>
                                                    <a href="{{aurl("categories/$item->id/edit")}}" id="edit"
                                                       class="btn btn-info">Edit</a>
                                                    <!-- Trigger the modal with a button -->
                                                    <a class="btn btn-danger delete" data-toggle="modal"
                                                       data-target="#delete_modal" data-table="categories"
                                                       data-id="{{$item->id}}">
                                                        <i class="fa fa-trash"></i></a>
                                                    <!-- Modal -->
                                                </td>
                                            </tr>
                                        @empty
                                            <p>No results found</p>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            {{--{!! Form::close() !!}--}}
                        </div>
                    </div>
                    <div id="news" class="tab-pane fade in active">
                        <h3>News</h3>
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($news as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{!!$item->content!!}</td>
                                            <td>
                                                <a href="{{aurl("news/$item->id")}}" id="show"
                                                   class="btn btn-info">Show</a>
                                                <a href="{{aurl("news/$item->id/edit")}}" id="edit"
                                                   class="btn btn-info">Edit</a>
                                                <!-- Trigger the modal with a button -->
                                                <a class="btn btn-danger delete" data-toggle="modal"
                                                   data-target="#delete_modal" data-table="news"
                                                   data-id="{{$item->id}}">
                                                    <i class="fa fa-trash"></i></a>
                                                <!-- Modal -->
                                            </td>
                                        </tr>
                                    @empty
                                        <p>No results found</p>
                                    @endforelse

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div id="delete_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Item</h4>
                </div>
                {!! Form::open(['url'=>'#','method'=>'delete', 'id'=> 'frm-delete']) !!}
                <div class="modal-body">
                    <h4>Are You Sure ?</h4>
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
@push('js')
    {{--<script src="{{ asset('vendor\datatables\dataTables.buttons.min.js') }}"></script>--}}
    {{--<script src="{{ asset('vendor\datatables\buttons.server-side.js') }}"></script>--}}
    {{--<script src="{{ asset('vendor/adminlte/dist/js/dataTables.bootstrap.min.js') }}"></script>--}}
    {{--<script src="{{ asset('vendor/adminlte/dist/js/jquery.dataTables.min.js') }}"></script>--}}

    <script>
        $(document).ready(function () {
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

            $('body').delegate('.table .delete', 'click', function (e) {
                let id = $(this).data('id');

                let table = $(this).data('table');
                let formResults = $('#delete-error');
                formResults.innerText = '';
                console.log(table)
                let url;
                if (table === 'news') {
                    url = '{{aurl("news")}}/' + id;
                } else if (table === 'categories') {
                    url = '{{aurl("categories")}}/' + id;
                }
                $('#frm-delete').on('submit', function (e) {
                    console.log(url)
                    e.preventDefault();
                    let form = $(this);
                    let data = form.serialize();

                    console.log(url);
                    $.ajax({
                        url: url,
                        data: {
                            '_token': '{{csrf_token()}}',
                            'id': id
                        },
                        type: 'DELETE',
                        dataType: 'JSON',
                        beforeSend:
                            function () {
                                formResults.removeClass().addClass('alert alert-info').html('Loading...')
                            },
                        success: function (results) {
                            console.log(results);
                            if (results.success) {
                                formResults.removeClass().addClass('alert alert-success').html(results.success);
                                $('#delete_modal' + id).modal('hide').fadeOut(1500);
                                Swal.fire({
                                    type: 'success',
                                    title: results.success,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                window.location.reload();
                            }
                        },
                        error: function (results) {
                            $.each(results.responseJSON.errors, function (index, val) {
                                toastr.info(val)
                            });
                            formResults.removeClass().addClass('alert alert-danger').html(results.responseJSON.message)
                        },
                    })
                })
            });
        })
    </script>
@endpush
