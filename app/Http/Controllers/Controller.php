<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;

// use Jenssegers\Agent\Agent;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public static $allow_list = [28,180,179,191];
    public static $SALE_DEPARTMENT_ID = 1;
    public static $TECH_DEPARTMENT_ID = 3;
    public static $HUMAN_DEPARTMENT_ID = 4;
    public static $LEAD_DEPARTMENT_ID = 5;
    public static $ADMIN_DEPARTMENT_ID = 6;
    public static $ACCOUNTANT_DEPARTMENT_ID = 8;
    public static $BIG_LEAD_ID = 10;

    public function checkAdmin(){
    // if(in_array(Auth()->user()->id, self::$allow_list)){
    //     return true;
    // }
        if(Auth::User()->admin_id <2){
            return true;
        }
        return false;
    }

    public function checkOutside(){
    // if(in_array(Auth()->user()->id, self::$allow_list)){
    //     return true;
    // }
        if(Auth::User()->role > 0){
            return true;
        }else{
            return false;
        }
    }

    public function checkMap(){
    if(in_array(Auth()->user()->id, self::$allow_list)){
        return true;
    }
        if($this->checkOutside()){
            return false;
        }
                if(Auth::User()->admin_id <2){
            return true;
        }

 $list = array(self::$SALE_DEPARTMENT_ID,
            self::$ADMIN_DEPARTMENT_ID,
            self::$LEAD_DEPARTMENT_ID,
            self::$BIG_LEAD_ID );
 
        $departs = DB::table("user_department")->where("user_id", Auth()->user()->id)->pluck("department_id")->toArray();

         foreach($departs as $depart){
            $permis_list = DB::table("department_permission")
            ->where("department_id",$depart)->pluck("permission_id")
            ->toArray();
            foreach($permis_list as $permis){

                if (in_array($permis, $list)) {
                    return true;
                }
            }
        }
            // $hid = DB::table("department")->where("id",$depart)->first()->hid;
            // dd($hid);

            // if (in_array($hid, $list)) {
            //     return true;
            // }
        
        return false;

    }
   public function checkAccount(){
    if(in_array(Auth()->user()->id, self::$allow_list)){
        return true;
    }
        if($this->checkOutside()){
            return false;
        }
        $list = array(self::$ACCOUNTANT_DEPARTMENT_ID,
            self::$ADMIN_DEPARTMENT_ID,
            self::$LEAD_DEPARTMENT_ID,
            self::$BIG_LEAD_ID );
       $departs = DB::table("user_department")->where("user_id", Auth()->user()->id)->pluck("department_id")->toArray();
   foreach($departs as $depart){
            $permis_list = DB::table("department_permission")
            ->where("department_id",$depart)->pluck("permission_id")
            ->toArray();
            foreach($permis_list as $permis){

                if (in_array($permis, $list)) {
                    return true;
                }
            }
        }
        return false;

    }

    public function checkHuman(){
    if(in_array(Auth()->user()->id, self::$allow_list)){
        return true;
    }
        if($this->checkOutside()){
            return false;
        }
        $list = array(self::$HUMAN_DEPARTMENT_ID,
            self::$ADMIN_DEPARTMENT_ID,
            self::$LEAD_DEPARTMENT_ID,
            self::$BIG_LEAD_ID );
         $departs = DB::table("user_department")->where("user_id", Auth()->user()->id)->pluck("department_id")->toArray();

           foreach($departs as $depart){
            $permis_list = DB::table("department_permission")
            ->where("department_id",$depart)->pluck("permission_id")
            ->toArray();
            foreach($permis_list as $permis){

                if (in_array($permis, $list)) {
                    return true;
                }
            }
        }
        return false;

    }

    public function checkContributeMap(){
    if(in_array(Auth()->user()->id, self::$allow_list)){
        return true;
    }
        if($this->checkOutside()){
            return false;
        }
        $list = array(self::$TECH_DEPARTMENT_ID ,
            self::$ADMIN_DEPARTMENT_ID,
            self::$LEAD_DEPARTMENT_ID,
            self::$BIG_LEAD_ID );
        $departs = DB::table("user_department")->where("user_id", Auth()->user()->id)->pluck("department_id")->toArray();
       

           foreach($departs as $depart){
            $permis_list = DB::table("department_permission")
            ->where("department_id",$depart)->pluck("permission_id")
            ->toArray();
            foreach($permis_list as $permis){

                if (in_array($permis, $list)) {
                    return true;
                }
            }
        }

        return false;

    }

      public function checkSaleMap(){
    if(in_array(Auth()->user()->id, self::$allow_list)){
        return true;
    }
        if($this->checkOutside()){
            return false;
        }
        $list = array(self::$SALE_DEPARTMENT_ID ,
            self::$ACCOUNTANT_DEPARTMENT_ID,
            self::$ADMIN_DEPARTMENT_ID,
            self::$LEAD_DEPARTMENT_ID,
            self::$BIG_LEAD_ID );

    $departs = DB::table("user_department")->where("user_id", Auth()->user()->id)->pluck("department_id")->toArray();

        foreach($departs as $depart){
            $permis_list = DB::table("department_permission")
            ->where("department_id",$depart)->pluck("permission_id")
            ->toArray();
            foreach($permis_list as $permis){

                if (in_array($permis, $list)) {
                    return true;
                }
            }
        }
       
        return false;

    }

    public function checkLead(){

    if(in_array(Auth()->user()->id, self::$allow_list)){
        return true;
    }
         $list = array(
            self::$BIG_LEAD_ID );

        if($this->checkOutside()){
            return false;
        }
       $departs = DB::table("user_department")->where("user_id", Auth()->user()->id)->pluck("department_id")->toArray();

            // dd($departs);
        foreach($departs as $depart){
            $permis_list = DB::table("department_permission")
            ->where("department_id",$depart)->pluck("permission_id")
            ->toArray();   
            // dd($permis_list);
            foreach($permis_list as $permis){

                if (in_array($permis, $list)) {
                    return true;
                }
            }
        }
        return false;

    }
    public function checkLeadDepart(){
    if(in_array(Auth()->user()->id, self::$allow_list)){
        return true;
    }
        if($this->checkOutside()){
            return false;
        }

         $list = array(
            self::$LEAD_DEPARTMENT_ID,
            self::$BIG_LEAD_ID );

 $departs = DB::table("user_department")->where("user_id", Auth()->user()->id)->pluck("department_id")->toArray();

          foreach($departs as $depart){
            $permis_list = DB::table("department_permission")
            ->where("department_id",$depart)->pluck("permission_id")
            ->toArray();
            foreach($permis_list as $permis){

                if (in_array($permis, $list)) {
                    return true;
                }
            }
        }
    
        return false;

    }

 public function getLead(){
        if($this->checkOutside()){
            return false;
        }
        $res = DB::table("user_department")
        ->leftJoin("department","department.id","user_department.department_id")
        ->where("department.mid",0)
        ->distinct()->pluck("user_department.user_id")->toArray();
        // dd("????");
        return $res;


    }

    
}