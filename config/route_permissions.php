<?php

use App\Modules\EnumManager\Enums\PermissionTypeEnum;
/**
 * Mapping permission with route
 * permission_name => route_name
 */

return [

    // Users
    PermissionTypeEnum::USER_INDEX_PERMISSION => 'users.index',
    PermissionTypeEnum::USER_STORE_PERMISSION => 'users.store',
    PermissionTypeEnum::USER_CREATE_PERMISSION => 'users.create',
    PermissionTypeEnum::USER_SHOW_PERMISSION => 'users.show',
    PermissionTypeEnum::USER_EDIT_PERMISSION => 'users.edit',
    PermissionTypeEnum::USER_UPDATE_PERMISSION => 'users.update',

    // Articles
    PermissionTypeEnum::HOME_PERMISSION => 'home',

    PermissionTypeEnum::ARTICLE_INDEX_PERMISSION => 'articles.index',
    PermissionTypeEnum::ARTICLE_STORE_PERMISSION => 'articles.store',
    PermissionTypeEnum::ARTICLE_CREATE_PERMISSION => 'articles.create',
    PermissionTypeEnum::ARTICLE_SHOW_PERMISSION => 'articles.show',
    PermissionTypeEnum::ARTICLE_EDIT_PERMISSION => 'articles.edit',
    PermissionTypeEnum::ARTICLE_UPDATE_PERMISSION => 'articles.update',
    PermissionTypeEnum::ARTICLE_APPROVE_PERMISSION => 'articles.approve',

];
