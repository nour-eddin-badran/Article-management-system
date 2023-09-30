@push('plugin-styles')
    <link rel="stylesheet" href="{{asset('admin/assets/dataTables/BS5/dt-bs5.min.css')}}">
@endpush

@push('custom-scripts')
    <script type="text/javascript" src="{{asset('admin/assets/dataTables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/dataTables/BS5/dt-bs5.min.js')}}"></script>

@endpush

<script>
    var _token = document.getElementsByName('_token')[0].content;
    const pageLength = 10;
    const pagingType = "full_numbers";
    const lengthMenu = [[10, 25, 50, 200, -1], [10, 25, 50, 200, "All"]];
    const SDOM = "<'row'<'m-auto float-left col-sm-12 col-md-6'il> <'m-auto float-right col-sm-12 col-md-6'B>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row text-center'<'col-12 text-center 'p> >";

    function datatable_filter() {
        return this.api().columns().every(function() {
            let column = this;
            let input;
            if ($(this.header()).hasClass("boolean")) {
                let options = `<option value="1">true</option>
                <option value="0">false</option>`;
                input = `<select class="form-select"><option value="">all</option>${options}</select>`;
            } else if ($(this.header()).hasClass("select")) {
                let options = "";
                $.each($(this.header()).data("select"), function(value, name) {
                    options += `<option value="${value}">${name}</option></option>`;
                });
                input = `<select class="form-select"><option value=''>{{__('global.all')}}</option>${options}</select>`;
            } else if ($(this.header()).hasClass("date")) {
                input = `<input type="date" class="form-control">`;
            } else if ($(this.header()).hasClass("disabled")) {
                input = document.createElement("input");
                input.classList.add("form-control");
                input.setAttribute("disabled", true);
            } else {
                input = document.createElement("input");
                input.classList.add("form-control");
            }
            $(input).appendTo($(column.footer()).empty()).on("change", function() {
                column.search($(this).val(), false, false, true).draw();
            });
        });
    }

    function datatableButtons(buttons = false, check_all = true, restoreButton = true, create = false) {
        let result = [];

        result.push({
            className: "btn btn-info btn-sm text-capitalize font-weight-bold",
            extend: "colvis",
            text: "<i class=\"fa fa-columns\"> columns </i>",
            collectionLayout: "fixed two-column",
        });

        result.push([
            {
                className: "btn btn-success btn-sm",
                text: "<i class=\"fas fa-sync-alt text-capitalize font-weight-bold\"> reload</i>",
                action: function(e, dt, node, config) {
                    dt.ajax.reload();
                },
            },
        ]);

        if (check_all === true) {
            result.push({
                className: "btn btn-primary btn-sm",
                text: "<i class=\"fa fa-check text-capitalize font-weight-bold\"> check all</i>",
                action: function(e, dt, node, config) {
                    $(".check-all").each(function() {
                        $(this).prop("checked", !$(this).prop("checked"));
                    });
                },
            });
        }


        if (buttons) {
            result.push(buttons);
        }

        if (create) {
            result.push({
                className: "btn btn-primary btn-sm",
                text: "<i class=\"fa fa-plus text-capitalize font-weight-bold\"> create</i>",
                action: function(e, dt, node, config) {
                    window.location.href = create;
                },
            });
        }

        return result;
    }

    function deleteAction(datatable_id, uri) {
        $(document).on('click', '.btn-delete', function () {
            if (!confirm("Are you sure?")) return;
            var rowid = $(this).data('rowid');
            var el = $(this)
            if (!rowid) return;
            $.ajax({
                type: "POST",
                dataType: 'DELETE',
                url: `/${uri}/${rowid}`,
                data: {_method: 'delete', _token: _token},
            }).always(function (data) {
                $(`#${datatable_id}`).DataTable().draw(false);
            })
        });
    }

    function getBadge(value) {
        switch (value)
        {
            case 'unverified' :
                return '<span class="badge badge-secondary">Unverified</span>'
            case 'blocked' :
                return '<span class="badge badge-danger">Blocked</span>'
            case 'active' :
                return '<span class="badge badge-success">Active</span>'
            case 'inactive' :
                return '<span class="badge badge-secondary">Inactive</span>'
            default :
                return '<span class="badge badge-primary">value</span>'
        }
    }


</script>
