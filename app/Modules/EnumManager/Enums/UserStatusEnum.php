<?php

namespace App\Modules\EnumManager\Enums;

use App\Modules\EnumManager\EnumTrait;

class UserStatusEnum
{
    use EnumTrait;

    const UNVERIFIED = 'unverified';
    const VERIFIED = 'verified';
    const BLOCKED = 'blocked';
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';
    const SUBSCRIBED = 'subscribed';
    const CERTIFIED = 'certified';
    const UNCERTIFIED = 'uncertified';
}
