<?php

namespace App\Modules\EnumManager\Enums;

use App\Modules\EnumManager\EnumTrait;

class RoleTypeEnum
{
    use EnumTrait;

    const ADMIN = 'admin';
    const AUTHOR = 'author';
}