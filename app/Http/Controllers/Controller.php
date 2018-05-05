<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function validation(Request $request, $rules)
    {
        $val = validator($request->all(), $rules);
        if ($val->fails()) {
            return response()->errors(
                __('message.errors'), 
                $val->errors(), 
                422);
        } else {
            return $val->valid();
        }
    }
    
    
}
