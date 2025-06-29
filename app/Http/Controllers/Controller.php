<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function getRouteByType($type)
    {
        return $type == 1 ? 'workflows-my-requests' : 'workflows-review-requests';
    }

    public function home()
    {
        $user = auth()->user();
        $route = 'workflows-review-requests';
        if ($user->hasPermissionTo('Dashboard')) {
            $route = 'dashboard';
        } else if ($user->hasPermissionTo('Lista mis solicitudes')) {
            $route = 'workflows-my-requests';
        } else if ($user->hasPermissionTo('Mis supervisiones')) {
            $route = 'my-visits';
        } else if ($user->hasPermissionTo('Lista supervisiones')) {
            $route = 'visits';
        }
        return redirect(route($route));
    }
}
