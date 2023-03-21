<?php

namespace App\Console\Commands;

use App\Common\Constants;
use App\Jobs\SendMail;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use FuzzyWuzzy\Fuzz;
use FuzzyWuzzy\Process;
use FuzzyWuzzy\Collection;

use Mail;


class NotiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'noti:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check trade balance have alert';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
       
        $this->fileNoti();
        // $this->eventNoti();
        // $this->JobNoti();
    }

    private function fileNoti(){

 
      $uids = DB::table("file_noti")->where("seen",0)->select("user_id")->distinct()->pluck('user_id')->toArray();
   // dd($uids);

        $cur = DB::table("files")->orderBy("id","desc")->first();
        $files = DB::table("files")->where("created_at",">",Carbon::today())->orderBy("id","desc")->get();
             foreach($uids as $uid){
                try{
                $user =  DB::table("users")->where("id",$uid)->first();
                  if($user->status == 0){
                    continue;
                }
                $data = ["email"=>$user->email,"files"=>$files];
                 Mail::send('filemail', $data, function($message) use ($data)  {
                     $message->to($data['email'], 'Thông báo hệ thống')->subject
                        ('Thông báo hệ thống ');
                     $message->from('automail.lopital@gmail.com','Lopital');
      });
   DB::table("file_noti")->where("seen",0)->where("user_id",$uid)->update(['seen'=>-1]);

}catch (\Exception $e){

            DB::table("file_noti")->where("seen",0)->where("user_id",$uid)->update(['seen'=>1]);
                }
                
             }

    }

    private function JobNoti()
    {

    
            $uids = DB::table("job_noti")->where("seen",0)->select("user_id")->distinct()->pluck('user_id')->toArray();
            // dd($uids);
             foreach($uids as $uid){
                try{
                $user =  DB::table("users")->where("id",$uid)->first();
                if($user->status == 0){
                    continue;
                }
                $data = ["email"=>$user->email];
                 Mail::send('staffmail', $data, function($message) use ($data)  {
                     $message->to($data['email'], 'Thông báo hệ thống')->subject
                        ('Thông báo hệ thống ');
                     $message->from('automail.lopital@gmail.com','Lopital');

                });

            DB::table("job_noti")->where("seen",0)->where("user_id",$uid)->update(['seen'=>-1]);
                }catch (\Exception $e){

            DB::table("job_noti")->where("seen",0)->where("user_id",$uid)->update(['seen'=>-2]);
                }

             }

    }


    private function eventNoti(){

            $uids = DB::table("event_noti")->where("seen",0)->select("user_id")->distinct()->pluck('user_id')->toArray();
   // dd($uids);
             foreach($uids as $uid){
                try{
                $user =  DB::table("users")->where("id",$uid)->first();
                
              if($user->status == 0){
                    continue;
                }

                $data = ["email"=>$user->email];
                 Mail::send('staffmail', $data, function($message) use ($data)  {
                     $message->to($data['email'], 'Thông báo hệ thống')->subject
                        ('Thông báo hệ thống ');
                     $message->from('automail.lopital@gmail.com','Lopital');
                  });
               DB::table("event_noti")->where("seen",0)->where("user_id",$uid)->update(['seen'=>-1]);

               }catch (\Exception $e){

                        DB::table("event_noti")->where("seen",0)->where("user_id",$uid)->update(['seen'=>1]);
                            }

                         }


    }




}