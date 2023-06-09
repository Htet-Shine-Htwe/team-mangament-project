<?php

namespace App\Services;

use App\Models\Invitation;

class RouteRedirectService
{
    public static $route ;
    public static $invitation;

    public static function getRoute(?string $url =null) :string
    {
            return self::$route = $url;
    }

    public static function getInvitation(string $id)
    {
        return self::$invitation = Invitation::where('id', $id)->first();
    }

}
