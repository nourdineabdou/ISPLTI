<?php

// is_active
use App\Models\Accompaniment;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

if (!function_exists('is_active')) {
    function is_active($url): string
    {
        $path = parse_url($url, PHP_URL_PATH);

        $route = Route::getRoutes()->match(request()->create($path));

        $routeName = $route->getName();

        return Str::startsWith(Route::currentRouteName(), $routeName) ? 'active' : '';
    }
}

// is_shown
if (!function_exists('is_shown')) {
    function is_shown($url): string
    {
        $path = parse_url($url, PHP_URL_PATH);

        $route = Route::getRoutes()->match(request()->create($path));

        $routeName = $route->getName();

        return Str::startsWith(Route::currentRouteName(), $routeName) ? 'show' : '';
    }
}

function formatNumber($number): string
{
    return number_format($number, 0, '.', ' ');
}

// has_any_permission

if (!function_exists('has_any_permission')) {
    function has_any_permission($permissions): bool
    {
        foreach ($permissions as $permission) {
            if (auth()->user()->can($permission)) {
                return true;
            }
        }
        return false;
    }
}

// order_is_payed
if (!function_exists('order_is_payed')) {
    function order_is_payed($order): bool
    {
        return $order->status === 'completed' && $order->payment_status === 'paid';
    }
}

// image_path
if (!function_exists('image_path')) {
    function image_path($image): string
    {
        // if image exists in storage folder return its path
        if (file_exists(public_path('storage/images/' . $image)) && $image !== null) {
            return asset('storage/images/' . $image);
        } else {
            // if image does not exist in storage folder return default image
            return asset('images/default.svg');
        }
    }
}

// get accompaniments names
if (!function_exists('get_accompaniments_names')) {
    function get_accompaniments_names($accompaniments): string
    {

        if (!$accompaniments) {
//            dd('null');
            return '';
        }

        $accompanimentsArray = array_map('trim', explode(',', $accompaniments));

        $accompanimentNames = [];
//        dd($accompanimentsArray);
        foreach ($accompanimentsArray as $accompaniment) {
//            $accompanimentNames[] = Accompaniment::find($accompaniment)->name;
            if ($accompaniment !== null) {
                $accompanimentNames[] = Accompaniment::find($accompaniment)->name;
            }
        }

//        dd(implode(', ', $accompanimentNames));

        return implode(', ', $accompanimentNames);
    }
}
