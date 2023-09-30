function callApi(url, method = 'GET', data = {}, sourceElementId = null) {
    $('#loaderImage').show();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        url: url,
        method: method,
        data: data,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        success: function (res) {
            $('#loaderImage').hide();

            if (sourceElementId != null) {
                if ($.isFunction(sourceElementId)) {
                    sourceElementId(res)
                } else {
                    $(`#${sourceElementId}`).DataTable().ajax.reload();
                }
            }

            if (method.toUpperCase() == 'POST') {
                toastr.success("Operation completed!", "Success");
            }
        },
        error: function (xhr, status, error) {
            $('#loaderImage').hide();
            toastr.error(xhr.responseJSON.message, "Error");
        },
    });
}
