<?php

use App\Modules\EnumManager\Enums\{PermissionTypeEnum, RoleTypeEnum};

return [

    RoleTypeEnum::ADMIN => [
        PermissionTypeEnum::USER_INDEX_PERMISSION,
        PermissionTypeEnum::USER_CREATE_PERMISSION,
        PermissionTypeEnum::USER_STORE_PERMISSION,
        PermissionTypeEnum::USER_SHOW_PERMISSION,
        PermissionTypeEnum::USER_EDIT_PERMISSION,
        PermissionTypeEnum::USER_UPDATE_PERMISSION,

        PermissionTypeEnum::ARTICLE_INDEX_PERMISSION,
        PermissionTypeEnum::ARTICLE_CREATE_PERMISSION,
        PermissionTypeEnum::ARTICLE_STORE_PERMISSION,
        PermissionTypeEnum::ARTICLE_SHOW_PERMISSION,
        PermissionTypeEnum::ARTICLE_EDIT_PERMISSION,
        PermissionTypeEnum::ARTICLE_UPDATE_PERMISSION,
        PermissionTypeEnum::ARTICLE_APPROVE_PERMISSION,
    ],

    RoleTypeEnum::AUTHOR => [
        PermissionTypeEnum::HOME_PERMISSION,

        PermissionTypeEnum::ARTICLE_INDEX_PERMISSION,
        PermissionTypeEnum::ARTICLE_CREATE_PERMISSION,
        PermissionTypeEnum::ARTICLE_STORE_PERMISSION,
        PermissionTypeEnum::ARTICLE_SHOW_PERMISSION,
        PermissionTypeEnum::ARTICLE_EDIT_PERMISSION,
        PermissionTypeEnum::ARTICLE_UPDATE_PERMISSION,
    ],

];
