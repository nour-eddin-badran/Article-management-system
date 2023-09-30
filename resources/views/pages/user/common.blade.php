<span class="badge badge-danger">{{ $user->is_blocked ? __('common.blocked_user') : '' }}</span>
<a class="btn btn-danger float-left" href="Javascript:void(0)" onclick="document.getElementById('user_block_form').submit()">
    {{ $user->is_blocked ? __('common.unblock_user') : __('common.block_user') }}

</a>

@if($user->status == \App\Modules\EnumManager\Enums\UserStatusEnum::ACTIVE)
    <a class="btn btn-primary float-left" href="Javascript:void(0)" onclick="document.getElementById('activation_form').submit()">
        {{ __('common.deactivate') }}

    </a>
@else
    <a class="btn btn-primary float-left" href="Javascript:void(0)" onclick="document.getElementById('activation_form').submit()">
        {{ __('common.activate') }}

    </a>
@endif

<form id="user_block_form" action="{{route('users.block_toggle', $user->id)}}" method="post">
    @csrf
    @method('patch')
</form>

<form id="activation_form" action="{{route('users.activation_toggle', $user->id)}}" method="post">
    @csrf
    @method('patch')
</form>
