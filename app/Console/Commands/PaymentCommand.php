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

class PaymentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pay:check';

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
       
        
             
$startDate = Carbon::today();
$endDate = Carbon::today()->addDays(7);
    
  $startDate = Carbon::today();
$endDate = Carbon::today()->addDays(7);
    
 $uids = DB::table('zone_task')
->leftJoin('zone', 'zone_task.zone_id', '=', 'zone.id')
->leftJoin('staff_task', 'zone_task.task_id', '=', 'staff_task.id')
->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
->whereBetween('end_date', [$startDate, $endDate])->pluck('consumer.user_id')->toArray();

             foreach($uids as $uid){
                try{
                if ($uid == 0){
                    continue;
                }
                $consumer =  DB::table("consumer")->where("user_id",$uid)->first();
                $contents = DB::table('zone_task')
->leftJoin('zone', 'zone_task.zone_id', '=', 'zone.id')
->leftJoin('staff_task', 'zone_task.task_id', '=', 'staff_task.id')
->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
->whereBetween('end_date', [$startDate, $endDate])
                ->where("consumer_id",$consumer->id)
                ->select("staff_task.name as sname")
                ->get();
                $text = "";
                foreach($contents as $content){
                    $text = $text."<div dir='ltr'>".$content->sname."</div>";
                } 
                $user =  DB::table("users")->where("id",$uid)->first();
                $data = ["name"=>$user->name,"email"=>$user->email,"content"=>$text];
                 Mail::send('tasknoti', $data, function($message) use ($data)  {
                     $message->to($data['email'], 'Thông báo hệ thống')->subject
                        ('Thông báo hệ thống ');
                     $message->from('automail.lopital@gmail.com','Lopital');

      });
              }   catch (\Exception $e){

          continue;

             }

            } 
              $uids = DB::table('zone_pay')
->leftJoin('zone', 'zone_pay.zone_id', '=', 'zone.id')
->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
->whereBetween('date', [$startDate, $endDate])->pluck('consumer.user_id')->toArray();

             foreach($uids as $uid){
                try{
                if ($uid == 0){
                    continue;
                }
                $consumer =  DB::table("consumer")->where("user_id",$uid)->first();
                $contents = DB::table('zone_pay')
->leftJoin('zone', 'zone_pay.zone_id', '=', 'zone.id')
->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
->whereBetween('date', [$startDate, $endDate])
                ->where("zone.consumer_id",$consumer->id)
                ->select("zone_pay.money as money","zone.name as name")
                ->get();
                $text = "";
                foreach($contents as $content){
                    $text = $text."<div dir='ltr'>"."<br>Căn hộ ".$content->name." cần thanh toán số tiền: ".number_format(floatval($content->money), 0, ",", ".") ." VND</div>";
                }
                // dd($uid);
                $user =  DB::table("users")->where("id",$uid)->first();
                $data = ["name"=>$user->name,"email"=>$user->email,"content"=>$text];
                 Mail::send('paynoti', $data, function($message) use ($data)  {
                     $message->to($data['email'], 'Thông báo hệ thống')->subject
                        ('Thông báo hệ thống ');
                     $message->from('automail.lopital@gmail.com','Lopital');

      });
           }catch (\Exception $e){

            DB::table("event_noti")->where("seen",0)->where("user_id",$uid)->update(['seen'=>1]);
                }  
         }

    }
}