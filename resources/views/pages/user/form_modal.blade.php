<x-modal id="add-user-modal" title="{{__('admin.add') . ' ' . __('admin.user')}}" uri="/users" dataTableId="users-table">
    <x-slot name="body">
        @include('pages.user.form', ['roles' => $roles])
    </x-slot>

    <x-slot name="metaJS">
        <script>
            payload_add_user_modal = {
                name: "user-name",
                email: "user-email",
                mobile: "user-mobile",
                password: "user-password",
                role_id: "user-role",
                user_type: "user-type",
            }
            required_add_user_modal = {
                name: "user-name",
                email: "user-email",
                mobile: "user-mobile",
                password: "user-password",
                role_id: "user-role",
            }
        </script>
    </x-slot>
</x-modal>

