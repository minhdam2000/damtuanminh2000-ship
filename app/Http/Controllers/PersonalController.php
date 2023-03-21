<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Credential;
use App\Broker;
use DB;
use File;
use App\Consumer;
use App\Staff;
use App\Accountant;

use App\Project;
use App\Area;
use App\Zone;
use App\Historyzone;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PersonalController extends Controller
{	
	public function job(Request $request){

    return view('personal.job');

        
    }

}