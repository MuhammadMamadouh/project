@extends('adminlte::page')
@section('title', 'Admins')
@section('content_header')
    <h1>Admins</h1>
@stop
@section('content')
    @include('admin.admins.create')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            {!! Form::open(['id'=>'form_data','url'=>aurl('users/destroy/all'),'method'=>'delete']) !!}
            {!! $dataTable->table(['class'=>'dataTable table table-responsive table-striped table-hover  table-bordered', 'id'=> 'table'],true) !!}
            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>
    <div id="mutlipleDelete" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">delete</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger">
                        <div class="empty_record hidden">
                            <h4>please check some records</h4>
                        </div>
                        <div class="not_empty_record hidden">
                            <h4>you want to delete <span class="record_count"></span> ? </h4>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="empty_record hidden">
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal">close</button>
                    </div>
                    <div class="not_empty_record hidden">
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal">no</button>
                        <input type="submit" value="yes" class="btn btn-danger del_all"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('#frm-insert').each(function () {
            this.reset()
        });
        $('delete').click(function () {
        })

    </script>
    <script src="{{ asset('vendor\datatables\dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor\datatables\buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}
@endpush
