@extends('layout.master')
@section('content')
@include('layout.datatable')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">{{__('common.home')}}</a></li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="d-flex justify-content-between  mb-4 float-right">
                            <div class="row w-100 mx-0">
                                <div class="px-0">
                                    {{--<div class="col-md-3 px-0 btn-group mb-3">--}}
                                        {{--<button class="btn btn-outline-primary dropdown-toggle"--}}
                                                {{--data-toggle="dropdown"--}}
                                                {{--type="button"> {{ __('common.with_selected') }} <span--}}
                                                    {{--class="caret"></span></button>--}}
                                        {{--<div class="dropdown-menu" role="menu">--}}
                                            {{--<a class="dropdown-item" href="#"--}}
                                               {{--onclick="action_overview('delete')">{{ __('common.delete') }}</a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </div>
                        <table id="users-table"
                               data-display-length='10'
                               class="table table-hover table-bordered table-sm display nowrap datatable_table"
                               width="100%">
                            <thead>
                            <tr>
                                <th class="disabled">#</th>
                                <th class="disabled">{{__('common.actions')}}</th>
                                <th>{{__('common.id')}}</th>
                                <th>{{__('common.name')}}</th>
                                <th>{{__('common.email')}}</th>
                                <th>{{__('common.mobile')}}</th>
                                <th>{{__('common.created_at')}}</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('pages.user.form_modal', ['roles' => $roles])
@stop
@push('custom-scripts')
    <script>
        $(function () {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                "scrollX": true,
                "sDom": SDOM,
                "aLengthMenu": [[100, 10, 75, 100], ["All", 10, 75, 100, "All"]],
                initComplete: datatable_filter,
                buttons: datatableButtons([{
                    className: "btn btn-primary btn-sm",
                    text: "<i class='fa fa-plus text-capitalize font-weight-bold' data-toggle='modal' data-target='#add-user-modal'> create</i>",
                }], false, false, false),
                ajax: '{!! route('users.index') !!}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable:false, searchable:false},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'created_at', name: 'created_at'},
                ],
            });
        });

        deleteAction('users-table', 'users')
    </script>
@endpush