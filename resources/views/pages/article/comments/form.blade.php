<form class="p-4" id="comment-form" action="@yield('form-route')" method="post">
    @csrf
    @yield('form-method')

    <x-textarea id="comment-content" label="{{ __('common.comment')}}" name="content" />

</form>