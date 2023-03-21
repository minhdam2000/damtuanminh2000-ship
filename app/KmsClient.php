<?php
namespace App;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
class KmsClient
{
    //Constructor
    public function __construct(){  
        $this->client = new Client();
    }

    //HTTPS GET API reqire Client verify certificate
    //Return false if seding has error
    //Else return response if success
    public function get($url){
        try{
            $this->client = new Client(['base_uri' =>$url]);
            $ret = $this->client->request      (
             'GET', '', 
            [
                //   'debug'=>true,
                'cert'=>['../certificate/server/server.pem', 'pass_Server_Key'],
                // 'ssl_key' =>'../certificate/server/server.key',
                'verify' =>false,
                'timeout'=>60
             ]
            );
            // dd($ret);
            return $ret;
        }catch(RequestException $e){
            $ret =(string) $e->getMessage();
            // dd($ret);
            return false;
        }   
    }   

    //HTTPS POST API reqire Client verify certificate
    //Return false if has error
    //Return response if success
    public function post($url, $formParamArray){
        try{
            $this->client = new Client(['base_uri' =>$url]);
            $ret = $this->client->request      (
                'POST', '', 
                [
                //form_params Array
                'form_params' =>$formParamArray,
                //   'debug'=>true,
                'cert'=>['../certificate/server/server.pem', 'pass_Server_Key'],
                // 'ssl_key' =>'../certificate/server/server.key',
                'verify' =>false,
                'timeout'=>10
                ]
            );
            return $ret;
        }catch(RequestException $e){
            $ret =(string) $e->getMessage();
            // dd($ret);
            return false;
        }
    }
}

