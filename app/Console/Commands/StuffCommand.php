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


class StuffCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stuff:check';

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
       
        $this->unLock();
        $this->ZoneNoti();
    }



    private function unLock()
    {

             DB::table('zone')->where('zone.lock',1)
             ->where('lock_time','<',Carbon::now()->subMinutes(15)->toDateTimeString())
             ->update([
              'lock_user' => 0,
              'lock_time' => Carbon::now(),
              'lock' => 0
            ]);
    }

     private function ZoneNoti()
    {
    
   $uids = DB::table("zone_noti")->where("seen",0)->select("user_id")->distinct()->pluck('user_id')->toArray();
   // dd($uids);
             foreach($uids as $uid){
                try{
                if ($uid == 0){
                    continue;
                }
                $contents = DB::table("zone_noti")->where("seen",0)->where("user_id",$uid)->get();
                $text = "";
                foreach($contents as $content){
                    $text = $text."\n".$content->content;
                } 
                // dd($uid);
                $user =  DB::table("users")->where("id",$uid)->first();
                $data = ["email"=>$user->email,"content"=>$text];
                 Mail::send('zonenoti', $data, function($message) use ($data)  {
                     $message->to($data['email'], 'Thông báo hệ thống')->subject
                        ('Thông báo hệ thống ');
                     $message->from('automail.lopital@gmail.com','Lopital');

      });
            DB::table("zone_noti")->where("seen",0)->where("user_id",$uid)->update(['seen'=>-1]);

 }catch (\Exception $e){

            DB::table("zone_noti")->where("seen",0)->where("user_id",$uid)->update(['seen'=>1]);
                }  
             }

        
    }

}