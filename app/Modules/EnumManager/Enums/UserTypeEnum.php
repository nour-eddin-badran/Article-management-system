<?php

namespace App\Modules\EnumManager\Enums;

use App\Modules\EnumManager\EnumTrait;

class UserTypeEnum
{
    use EnumTrait;

    const AUTHOR = 'author';
    const MANAGERIAL = 'managerial';
}
