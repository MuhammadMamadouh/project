@extends('adminlte::page')
@section('title', $title)
@section('content_header')
    <h1>{{$title}}</h1>
@stop
@section('content')
    @include('admin.categories.create')
    <div class="box">

        <div class="box-body">
            {{--{!! Form::open(['id'=>'form_data','url'=>aurl('users/destroy/all'),'method'=>'delete']) !!}--}}
            {!! $dataTable->table(['class'=>'dataTable table table-responsive table-striped table-hover  table-bordered', 'id'=> 'table'],true) !!}
            {{--{!! Form::close() !!}--}}
        </div>

    </div>

@endsection
@push('js')
    <script>
        $('#frm-insert').each(function () {
            this.reset()
        });
    </script>
    <script src="{{ asset('vendor\datatables\dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor\datatables\buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}
@endpush
