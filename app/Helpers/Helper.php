<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Helper
{
    private static $gravatar = 'https://www.gravatar.com/avatar/hash?d=identicon';

    /**
     * Get avatarUrl for badge
     * @param string $avatar
     * @param string $email
     * @return string
     */
    public static function getAvatar($avatar, $email)
    {
        if (!Str::contains($avatar, 'https://')) {
            return str_replace(
                'hash',
                md5(strtolower(trim($email))),
                self::$gravatar
            );
        } else {
            return $avatar;
        }
    }
}
