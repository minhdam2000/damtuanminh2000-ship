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



class FuzzyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fuzzy:check';

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
        // $data = DB::table("finance")
        // ->get();
        // foreach($data as $row){
        //     $note = "Hợp đồng tư vấn";
        //     $amount = str_replace(",","",$row->amount);

        //     DB::table("finance")
        //     ->where("id",$row->id)
        //     ->update([
        //         "amount"=>$amount,
        //         "note"=>$note,
        //     ]);


        // }
        // dd("!23");
       $fuzz = new Fuzz();
       $choices = new Collection();
       $process = new Process($fuzz);

       $array_goc1 = DB::table("contribute_file")->pluck("name")->toArray(); 
       $array_goc2 = DB::table("files")->pluck("name")->toArray(); 

       $array_goc = array_merge( $array_goc1,$array_goc2 );
       //dd($array_goc); 
       $display_data = [];
       foreach($array_goc as $file){
       $file_search = $file;
       $row_data=[];
       $min_fuzzy = 85;
       $final_data = [];
            foreach($array_goc as $row)
                {
                 if($fuzz->ratio( $file_search ,$row) > $min_fuzzy && $fuzz->ratio( $file_search ,$row) < 100)
                    {
                        $check = DB::table("file_fuzzy")
                        ->where("name",$file_search)
                        ->where("same_name",$row)
                        ->first();

                        $check2 = DB::table("file_fuzzy")
                        ->where("same_name",$file_search)
                        ->where("name",$row)
                        ->first();

                        if($check == null && $check2 == null){
                            DB::table("file_fuzzy")
                            ->insert([
                                "name"=>$file_search,
                                "same_name"=>$row

                            ]);
                        }
                    }   

                }
           
         }  
    }   

}
