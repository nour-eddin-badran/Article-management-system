<div class="modal fade" id="{{ isset($id) ? $id : 'modal-id' }}" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog {{ $modal_size ?? '' }}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ isset($title) ? $title : 'modal-title' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="overflow:hidden;">
                {{ isset($body) ? $body : 'modal-body' }}
            </div>

            <div class="modal-footer">
                @if (isset($footer))
                    {{ $footer }}
                @else
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('common.cancel') }}</button>
                    <button id="btn-{{ isset($id) ? $id : '' }}-submit" type="button"
                            class="btn btn-primary">{{ __('common.add') }}</button>
                @endif

            </div>
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        var sufix = "{{ str_replace('-', '_', $id) }}";
        window[`isBulkAction_${sufix}`] = false;
        window[`binding_${sufix}`] = {};
        window[`payload_${sufix}`] = {};
        window[`required_${sufix}`] = {};
        window[`clearableSelects_${sufix}`] = {};
    </script>

    @isset($metaJS)
        {{ $metaJS }}
    @endisset

    <script>
        $(document).ready(() => {
            var uri = "{{ $uri }}",
            _this = $(this)
            _this.uri = uri;

        $('#btn-{{ $id }}-submit').on('click', function(e) {
            sufix = "{{ str_replace('-', '_', $id) }}";

            if (!formValidation()) {
                toastr.warning("{{ __('messages.missing_required_fields') }}",
                    "{{ __('common.warning') }}");
                return;
            }

            $('#loaderImage').show();

            // Preparing the payload
            var formData = new FormData();

            setFormDataFromGivenPayload(formData);
            checkAndApplyRouteBindingIfExists();
            checkBulkActionIfExists(formData);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                url: `${_this.uri}`,
                method: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function(res) {
                    $('#loaderImage').hide();

                    toastr.success("{{ __('messages.operation_succeeded') }}",
                        "{{ __('common.success') }}");

                    // Reset the form
                    $('#{{ $id }}').find(
                        "input[type=text], input[type=password], input[type=email], input[type=number], textarea"
                    ).val("");

                    // Reset Dropdownlist
                    for (const [key, value] of Object.entries(eval(
                        `clearableSelects_${sufix}`))) {
                        clearDropDownlistById(value);
                    }

                    $('#{{ $dataTableId }}').DataTable().ajax.reload();

                    {{-- $('#{{$id}}').modal('hide'); --}}
                    $('#{{ $id }} .close').click();
                },
                error: function(xhr, status, error) {
                    $('#loaderImage').hide();
                    toastr.error(xhr.responseJSON.message, "{{ __('common.error') }}");
                },
            });

        })

        function setFormDataFromGivenPayload(formData) {
            for (const [key, value] of Object.entries(eval(`payload_${sufix}`))) {
                if ($("#" + value).attr('type') === 'file') {
                    var files = $("#" + value)[0].files;

                    if (files.length == 1) {
                        formData.append(key, files[0]);
                    } else {
                        for (var i = 0; i < files.length; i++) {
                            formData.append(key + "[]", files[i]);
                        }
                    }
                } else if ($("#" + value).attr('type') === 'checkbox') {
                    formData.append(key, $("#" + value).is(":checked"));
                } else {
                    formData.append(key, $("#" + value).val());
                }
            }
        }

        function formValidation() {
            for (const [key, value] of Object.entries(eval(`required_${sufix}`))) {
                if (!$("#" + value).val()) {
                    return false;
                }
            }
            return true;
        }

        function checkAndApplyRouteBindingIfExists() {
            for (const [key, value] of Object.entries(eval(`binding_${sufix}`))) {
                for (const [key2, value2] of Object.entries(value)) {
                    _this[key] = _this[key].replace(`:${value2}`, $(`#${value2}`).val())
                }
            }
        }

        function checkBulkActionIfExists(formData) {
            if (eval(`isBulkAction_${sufix}`)) {
                var rowsIds = $('#bulk-action-rows-ids').val();
                formData.append('rowsIds', rowsIds);
            }
        }
        });
    </script>
@endpush
