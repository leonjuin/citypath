<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests; 

    protected function buildFailedValidationResponse(Request $request, array $error)
    {
        if ($request->expectsJson()) {
            $error = head($error);
        	$error = head($error);
            
        	if(!str_contains($error, ':')){
        		$error .= ':422';
        	}
        	$error = explode(':', $error);
            return response($error[0], $error[1]);
        }

        return redirect()->to($this->getRedirectUrl())
                        ->withInput($request->input())
                        ->withErrors($error, $this->errorBag());
    }
}
