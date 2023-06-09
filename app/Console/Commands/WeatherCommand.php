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



class WeatherCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:check';

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
       
    $projects = DB::table("projects")::get();
        foreach ($projects as $project) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://weather.ls.hereapi.com/weather/1.0/report.json?product=observation&language=vi&name='.str_replace(" ","%20",$project->city).'&apiKey=blMM5PIbYla1kqp5TsIYvT-j8TDUg79spl39-vYRcPQ');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


    $headers = array();
    $headers[] = 'Content-Type: *';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    // DB::table("weather")->where("start",">=",Carbon::today()->format('Y-m-d'))->delete();
    $data = (json_decode($result));

    $value = ($data->observations->location[0]->observation[0]);
    DB::table("weather")->where("project_id",$project->id)->where("start",explode("T",$value->utcTime)[0])->delete();
        // dd(explode("T",$value->utcTime)[0]);
        // print_r($value);
        DB::table("weather")->insert([
              "des"=>$value->description,
              "low"=>$value->lowTemperature,
              "high"=>$value->highTemperature,
              "project_id"=>$project->id,
              "humidity"=>$value->humidity,
              "start"=>explode("T",$value->utcTime)[0],
              "end"=>explode("T",$value->utcTime)[0]
        ]);
    // tong 7 ngay
    // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://weather.ls.hereapi.com/weather/1.0/report.json?product=forecast_7days_simple&language=vi&name='.str_replace(" ","%20",$project->city).'&apiKey=blMM5PIbYla1kqp5TsIYvT-j8TDUg79spl39-vYRcPQ');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


    $headers = array();
    $headers[] = 'Content-Type: *';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    // DB::table("weather")->where("start",">=",Carbon::today()->format('Y-m-d'))->delete();
    $data = (json_decode($result));

    $data = $data->dailyForecasts;
    foreach ($data as $data) {
      // dd($data->forecast);
      $forecast = $data->forecast;
      foreach ($forecast as $value) {

    DB::table("weather")->where("project_id",$project->id)->where("start",explode("T",$value->utcTime)[0])->delete();
        // dd(explode("T",$value->utcTime)[0]);
        // print_r($value);
        DB::table("weather")->insert([
              "des"=>$value->description,
              "low"=>$value->lowTemperature,
              "high"=>$value->highTemperature,
              "project_id"=>$project->id,
              "humidity"=>$value->humidity,
              "start"=>explode("T",$value->utcTime)[0],
              "end"=>explode("T",$value->utcTime)[0]
        ]);
        }
        }
        }

    }
}