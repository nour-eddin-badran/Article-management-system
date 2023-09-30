<?php

namespace App\Modules\EnumManager\Enums;

use App\Modules\EnumManager\EnumTrait;

class SettingEnum
{
    use EnumTrait;

    const TERMS_AND_CONDITIONS = 'terms_and_conditions';
    const PRIVACY_POLICY = 'privacy_policy';
    const REFERRAL_POINTS_COUNT = 'referral_points_count';
    const PAGINATION_SIZE = 'pagination_size';
}