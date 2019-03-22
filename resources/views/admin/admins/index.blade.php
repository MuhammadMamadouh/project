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
            {{--{!! Form::open(['id'=>'form_data','url'=>aurl('users/destroy/all'),'method'=>'delete']) !!}--}}
            {!! $dataTable->table(['class'=>'dataTable table table-responsive table-striped table-hover  table-bordered', 'id'=> 'table'],true) !!}
            {{--{!! Form::close() !!}--}}
        </div>
        <!-- /.box-body -->
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
