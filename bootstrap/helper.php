<?php

use Illuminate\Support\Facades\Auth;


if (!function_exists('get_guard')) {
    function get_guard()
    {
        if (Auth::guard('admin')->check()) {
            return "admin";
        }

        if (Auth::guard('merchant')->check()) {
            return "merchant";
        }

        if (Auth::guard('marketing')->check()) {
            return "marketing";
        }

        return "user";
    }
}

