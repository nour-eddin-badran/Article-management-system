<?php

namespace App\Modules\EnumManager\Enums;

use App\Modules\EnumManager\EnumTrait;

class GeneralEnum
{
    use EnumTrait;

    const PAYMENT_METHOD_KEY = 'X-PAYMENT-METHOD';

    const SUCCESS = 'success';
    const INTERNAL_ERROR = 'internal_error';
    const VALIDATION = 'validation';
    const UNAUTHORIZED = 'unauthorized';
    const INVALID_CREDENTIALS = 'invalid_credentials';
    const NOT_VERIFIED = 'not_verified';
    const BLOCKED = 'blocked';
    const NOT_FOUND = 'not_found';
    const NOT_EXISTED = 'not_existed';
    const NOT_ALLOWED = 'not_allowed';
    const ALREADY_VERIFIED = 'already_verified';
    const ALREADY_BOOKED = 'already_booked';
    const ALREADY_ACTIVATED = 'already_activated';
    const ALREADY_PAID = 'already_paid';
    const ALREADY_REFERRED = 'already_referred';
    const INVALID_VERIFICATION_CODE = 'invalid_verification_code';
    const SESSION_COLLISION = 'session_collision';
    const CANT_BE_RATED = "can't be rated";
    const UNEXPECTED_ERROR = 'unexpected_error';
    const DECLINED_TRANSACTION = 'declined_transaction';
    const PENDING_TRANSACTION = 'pending_transaction';
}
