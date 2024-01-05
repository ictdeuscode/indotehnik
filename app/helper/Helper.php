<?php

use Illuminate\Support\Facades\Gate;

if(!function_exists('set_active')) {
    function set_active($uri, $output = 'active') 
    {
        if (is_array($uri)) {
            foreach ($uri as $u) 
            {
                if(Route::is($u)) 
                {
                    return $output;
                }
            }
        } else 
        {
            if(Route::is($uri)) 
            {
                return $output;
            }
        }
        
    }
}

if (!function_exists('checkPermission')) {
    function checkPermissions($permissions)
    {
        $arrayCheck = array();
        foreach($permissions as $permission)
        {
            $arrayCheck[] = Gate::allows('hasPermission', $permission);
        }

        return in_array(true, $arrayCheck);
    }
}
