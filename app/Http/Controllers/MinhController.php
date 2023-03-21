<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManagerStatic as Image;

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
use App\Duong2amlich;
use Mail;

use Illuminate\Support\Str;
use Illuminate\Http\Request;


use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\SimpleType\TblWidth;



class MinhController extends Controller
{	
 public function list(){
   // dd(Duong2amlich::convertSolar2Lunar("1999-01-15"));
   dd(Duong2amlich::convertLunar2Solar("1998-11-28"));
    // $processes  = DB::table("process")->where("process.project_id",">",0)->get();

//        $processes = DB::table("process")->get();
// // dd($processes);
//     return view('minh.project',compact('processes'));
  }


}