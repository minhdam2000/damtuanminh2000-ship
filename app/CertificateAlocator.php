<?php
namespace App;
use Carbon\Carbon; 
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
class CertificateAlocator
{
    const CA_CRT_PATH = '../certificate/ca.crt';
    const CA_SEQ_PATH = '../certificate/ca.seq';
    const CA_KEY_PATH = '../certificate/ca.key';
    
    //Generate proxy certificate, return false if has error while processing
    //Else return array off attribute:
    // 'ca':'CA certificate'
    //  'proxyCrt':'Proxy certificate'
    //  'proxyKey':'Proxy private key'
    public static function genProxyCertificate(){
        $fileName = Str::random(10);
        $keyPath = "/tmp/$fileName.key";
        $tryTime = 0;
        while(file_exists($keyPath) && $tryTime<10){
            $lastAccess = fileatime($keyPath);
            $lastAccess = Carbon::createFromTimestamp($lastAccess);
            $currentTime = Carbon::now();
            $diffSecond = $lastAccess->diffInSeconds($currentTime);
            if($diffSecond > 100){
                break;
            }
            $fileName = Str::random(10);
            $keyPath = "/tmp/$fileName.key";
            $tryTime ++;
        }
        $crtPath = "/tmp/$fileName.crt";
        $csrPath = "/tmp/$fileName.csr";
        $tryTime =0;
        do{
            exec('openssl req -new -utf8 -nameopt multiline,utf8 -subj "/C=VN/CN=BKCS Secure Proxy/O=BKCS" -newkey rsa:2048 -passout pass:"pass_Proxy_Key" -keyout '.$keyPath.' -out '.$csrPath);
            exec('openssl x509 -req -days 36500 -in '.$csrPath.' -CA '.self::CA_CRT_PATH.' -CAkey '.self::CA_KEY_PATH.' -CAcreateserial -CAserial '.self::CA_SEQ_PATH.' -out '.$crtPath);
            $tryTime ++;
        }while(!(file_exists($keyPath) && file_exists($crtPath)) && $tryTime <10);
        if($tryTime == 10){
            return false;
        }
        // $proxyKey = file_get_contents($keyPath);
        // $proxyCrt = file_get_contents($crtPath);
        // $ca = file_get_contents(self::CA_CRT_PATH);
        // $ret = [
        //         'proxyKey'=>$proxyKey,
        //         'proxyCrt'=>$proxyCrt,
        //         'ca' =>$ca
        //     ];
        // return $ret;
        return $fileName;
    }
}

