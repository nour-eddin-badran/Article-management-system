@extends('layout.master')
@section('content')
@include('layout.datatable')

@push('custom-scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
@endpush

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
                                </div>
                            </div>
                        </div>
                        <table id="articles-table"
                               data-display-length='10'
                               class="table table-hover table-bordered table-sm display nowrap datatable_table"
                               width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('common.actions')}}</th>
                                <th>{{__('common.id')}}</th>
                                <th>{{__('common.title')}}</th>
                                <th>{{__('common.author')}}</th>
                                <th>{{__('common.status')}}</th>
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

    @include('pages.article.form_modal')
@stop
@push('custom-scripts')
    <script>
        $(function () {
            $('#articles-table').DataTable({
                processing: true,
                serverSide: true,
                "scrollX": true,
                "sDom": SDOM,
                "aLengthMenu": [[100, 10, 75, 100], ["All", 10, 75, 100, "All"]],
                initComplete: datatable_filter,
                buttons: datatableButtons([{
                    className: "btn btn-primary btn-sm",
                    text: "<i class='fa fa-plus text-capitalize font-weight-bold' data-toggle='modal' data-target='#add-article-modal'> {{__('common.add')}} </i>",
                }], false, false, false),
                ajax: '{!! route('admin.articles.index') !!}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable:false, searchable:false},
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'author.resource.name', name: 'author.resource.name'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at.date', name: 'created_at.date'},
                ],
            });
        });

        deleteAction('articles-table', 'articles')
    </script>
@endpush