<?php
use App\Modules\EnumManager\Enums\PermissionTypeEnum;
?>

<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{route('home')}}" class="sidebar-brand">
            Article <span>MS</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">

            @can(PermissionTypeEnum::HOME_PERMISSION)
                <li class="nav-item {{ \App\Helpers\TemplateHelper::active_class(['home', 'home/*']) }}">
                    <a class="nav-link" href="{{ route('home') }}" role="button"
                       aria-expanded="{{ \App\Helpers\TemplateHelper::is_active_route(['home', 'home/*']) }}">
                        <i class="link-icon" data-feather="home"></i>
                        <span class="link-title">{{__('common.home')}}</span>
                    </a>
                </li>
            @endcan

            @can(PermissionTypeEnum::USER_INDEX_PERMISSION)
                <li class="nav-item {{ \App\Helpers\TemplateHelper::active_class(['users', 'users/*']) }}">
                    <a class="nav-link" href="{{ route('users.index') }}" role="button"
                       aria-expanded="{{ \App\Helpers\TemplateHelper::is_active_route(['users', 'users/*']) }}"
                       aria-controls="email">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">{{__('common.users_management')}}</span>
                    </a>
                </li>
            @endcan

            @can(PermissionTypeEnum::ARTICLE_INDEX_PERMISSION)
                <li class="nav-item {{ \App\Helpers\TemplateHelper::active_class(['articles', 'articles/*']) }}">
                    <a class="nav-link" href="{{ route('admin.articles.index') }}" role="button"
                       aria-expanded="{{ \App\Helpers\TemplateHelper::is_active_route(['articles', 'articles/*']) }}"
                       aria-controls="email">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">
                            @if(authUser()->hasRole(\App\Modules\EnumManager\Enums\RoleTypeEnum::AUTHOR))
                                {{__('common.my_articles')}}
                            @else
                                {{__('common.articles_management')}}
                            @endif

                        </span>
                    </a>
                </li>
            @endcan

        </ul>
    </div>
</nav>