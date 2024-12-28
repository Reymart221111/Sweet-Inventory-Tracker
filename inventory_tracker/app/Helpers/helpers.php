<?php

if(!function_exists('isActive'))
{
    function isActive($routes, $activeClass = 'bg-sweetBlue rounded-lg', $inactiveClass = 'hover:bg-sweetBlue rounded-lg')
    {
        $routes = (array)$routes;

        foreach($routes as $route)
        {
            if(Route::is($route))
            {
                return $activeClass;
            }
        }
        return $inactiveClass;
    }
}