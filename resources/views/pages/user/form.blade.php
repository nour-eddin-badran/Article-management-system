<form class="p-4" id="user-form" action="@yield('form-route')" method="post">
    @csrf
    @yield('form-method')

    <x-input id="user-name" label="{{ __('common.name')}}" name="name" :entity="$user ?? ''"/>

    <x-input id="user-email" label="{{ __('common.email')}}" name="email" type="email" :entity="$user ?? ''" />

    <x-input id="user-password" label="{{ __('common.password')}}" name="password" type="password" :entity="$user ?? ''"  />

    <x-input id="user-mobile" label="{{ __('common.mobile')}}" name="mobile" type="text" :entity="$user ?? ''" />

    <x-input id="user-type" type="hidden" label="{{ __('common.user_type')}}" name="user_type" value="{{\App\Modules\EnumManager\Enums\UserTypeEnum::MANAGERIAL}}" />

    <x-select id="user-role" label="{{ __('common.the_role')}}" name="role_id" :resources="$roles" :entity_id="$user_role_id ?? 0" />

    {{--<x-select id="user-programs" label="{{ __('admin.programs')}}" visibility="false" name="programs_ids[]" type="multiple" :resources="$programs" :entity_id="$user_programs_ids ?? 0" />--}}


    @if(isset($source) && $source == 'update')
        <button type="submit" class="btn btn-primary mr-2">{{ __('admin.update')}}</button>
        <a id="btn-cancel" href="{{route('users.index')}}"
           class="btn btn-light">{{__('admin.cancel')}}</a>
    @endif

</form>

@push('plugin-scripts')
    <script>
        $(document).ready(() => {

        @if(isset($source) && $source == 'update')
        $("#user-form :input").change(function() {
            $("#user-form").attr("changed",true);
        });

        $('#btn-cancel').on('click', function (e) {
            if ($("#user-form").attr("changed") === "true") {
                if (confirm("{{__('messages.do_you_want_to_save_the_changes')}}")) {
                    e.preventDefault()
                    $("#user-form").submit();

                }
            }
        })
        @endif



        })
    </script>
@endpush