@extends('layouts.AdminLTE')


@section('pageHeader')
    {{ title }}
@endsection

@section('header-links')
    {{-- <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('/') }}/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('/') }}/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('extra-styles')
    <style>

    </style>
@endsection

@section('crudButtons')
    @can('staff-create')
        <a data-toggle="modal" data-target="#modal" class="btn btn-outline-primary btn-xs add" id="add" href="#"
            role="button">
            <i class="fas fa-plus"></i> Add
        </a>
    @endcan
@endsection

@section('content')
    <div class="card">

        <div class="card-body">

            @include('partials.alerts')


            @livewire('duty.working-hrs.show')


        </div>
        <!-- /.card-body -->
    </div>
@endsection



@section('extra-script')
    <script src="{{ asset('/') }}/adminlte/plugins/datatables/jquery.dataTables.min.js" defer></script>
    <script src="{{ asset('/') }}/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js" defer></script>
    <script src="{{ asset('/') }}/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js" defer></script>
    <script src="{{ asset('/') }}/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js" defer></script>
    <script src="{{ asset('js/task.js') }}"></script>


    <script defer>
        $(document).ready(function() {
            //dom not only ready, but everything is loaded

            /* WHEN DELETE BUTTON IS CLICKED */
            $('#add').click(function() {
                $('#modal-danger').modal('show');
            });




            // end of dom load
        });
    </script>
@endsection

@section('modals')
@endsection
