<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Proxy;  
use App\Nvr;
use App\CertificateAlocator;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class SuperAdminController extends Controller
{	
    public function createProxy(){

        if(Auth()->user()->role_id != 1){
            return 'You are not permission';
        }
        // dd("abc");
        $newProxy = new Proxy();
        $newProxy->master_key = Str::random(30);
        $newProxy->password  = 'admin123';
        if($newProxy->save()){
            //Create certificate
            $newProxy->refresh();
            $fileConfig = '{"id":"'.$newProxy->id.'","password":"admin123","masterkey":"'.$newProxy->master_key.'","passchanged":false,"usepass":false}';

            try{
                file_put_contents('/tmp/proxy_'.$newProxy->id.'.json', $fileConfig);
                return response()->download("/tmp/proxy_$newProxy->id.json");
            }
            catch(\Exception $e){
                return "Error when write file";
            }
        }
        return 'Can not create device';
    }


    public function createNvr(){
        if(Auth()->user()->role_id != 1){
            return 'You are not permission';
        }
        $newNvr = new Nvr();
        $newNvr->master_key = Str::random(30);
        $newNvr->password  = 'admin123';
        if($newNvr->save()){
            $newNvr->refresh();
            $fileConfig = '{"id":"'.$newNvr->id.'","password":"admin123","masterkey":"'.$newNvr->master_key.'","passchanged":false,"usepass":false}';
            try{
                file_put_contents('/tmp/nvr_'.$newNvr->id.'.json', $fileConfig);
                return response()->download('/tmp/nvr_'.$newNvr->id.'.json');
            }
            catch(\Exception $e){
                return "Error when write file";
            }
        }
        return 'Can not create device';
    }

    public function downloadCertificate(){
        if(Auth()->user()->role_id != 1){
            return 'You are not permission';
        }
        $cerPath = CertificateAlocator::genProxyCertificate();
        if($cerPath == false){
            return "Error when create certificate";
        }
        $currDir = getcwd();
        $filePath = "/tmp/$cerPath";
        try{
            exec('zip -j '.$filePath.'.zip '.$filePath.'.key '.$filePath.'.crt '.$currDir.'/'.CertificateAlocator::CA_KEY_PATH);
            return response()->download($filePath.'.zip');
        }catch(Exception $e){
            return "Error when create certificate";
        }
    }
}