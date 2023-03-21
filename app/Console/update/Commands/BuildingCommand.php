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



class BuildingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'build:check';

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
       $data = DB::table("building_messages")
       ->where("attachment","<>",null)->get();

       foreach($data as $file)
       {
            $count = DB::table("building_files")->where("message_id",$file->id)
            ->count();

            if($count > 0){
                continue;
            }
            $myurl = explode(',',$file->attachment);
            DB::table("building_files")->insert([
                "build_id"=>$file->building_id,
                "message_id"=>$file->id,
                "name"=>$myurl[1],
                "url"=>"/storage/public/attachments/".$myurl[0],
            ]);
       }
    }   

}
