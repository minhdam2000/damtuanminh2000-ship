<?php

namespace App\Console\Commands;

use App\Common\Constants;
use App\Jobs\SendMail;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;



class CleanFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'file:clean';

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
    {   $delete_file = 0;
        $fileList = glob('storage/app/contribute/*');
        foreach($fileList as $filename){
            if(is_file($filename)){
                $filecheckname = explode("/", $filename);
                $filecheckname = end($filecheckname);
                echo $filename."\n"; 
                $check1 = DB::table("files")->where("url","like","%".$filecheckname."%")->first();
                $check2 = DB::table("contribute_file")->where("url","like","%".$filecheckname."%")->first();
                $check3 = DB::table("building_files")->where("url","like","%".$filecheckname."%")->first();

                if($check1 == null && $check2 == null && $check3 ==null){
                    unlink($filename);
                    $delete_file = $delete_file+1;
                }
            }   
        }
        $fileList = glob('storage/app/system/*');
        foreach($fileList as $filename){
            if(is_file($filename)){
                $filecheckname = explode("/", $filename);
                $filecheckname = end($filecheckname);
                echo $filename."\n"; 
                $check1 = DB::table("files")->where("url","like","%".$filecheckname."%")->first();
                $check2 = DB::table("contribute_file")->where("url","like","%".$filecheckname."%")->first();
                $check3 = DB::table("building_files")->where("url","like","%".$filecheckname."%")->first();

                if($check1 == null && $check2 == null && $check3 ==null){
                    unlink($filename);
                    $delete_file = $delete_file+1;
                }
            }   
        }

        $fileList = glob('storage/app/contribute/*');
        foreach($fileList as $filename){
            if(is_file($filename)){
                $filecheckname = explode("/", $filename);
                $filecheckname = end($filecheckname);
                echo $filename."\n"; 
                $check1 = DB::table("files")->where("url","like","%".$filecheckname."%")->first();
                $check2 = DB::table("contribute_file")->where("url","like","%".$filecheckname."%")->first();
                $check3 = DB::table("building_files")->where("url","like","%".$filecheckname."%")->first();

                if($check1 == null && $check2 == null && $check3 ==null){
                    unlink($filename);
                    $delete_file = $delete_file+1;
                }
            }   
        }

        echo "delete File: ".$delete_file;

      
    }   

}
