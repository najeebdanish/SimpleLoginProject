<?php

namespace App\Http\Controllers;

use Log;
use Auth;

class AdminController extends Controller
{
    

    public function renderAdminHome()
    {
		Log::info('renderAdminHome()');
		$user=Auth::user();
		$redirectPath = '/home';
		if($user!=null){
			Log::info($user);
			if($user->isAdmin){
				Log::info('Condition');
				$viewName = 'adminhome';
				return view($viewName);
			}
		}
		return redirect($redirectPath);        
    }

}
