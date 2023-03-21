<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Proxy;
use App\Nvr;
use App\User;
use App\ApiResponse;
use App\Camera;
use App\UserLocationAccess;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * return Response
     */
    public function apiLoginUser(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // if (Auth::attempt($credentials)) {
        //     $user = Auth::user();            // Authentication passed...
        //     session(['USER_ID' => $user->id]);
        //     return ApiResponse::ok('Login success');

        // dd($credentials);    
        $user = User::where('email', $credentials['email'])->get();
        if(count($user)!= 0 && Hash::check($credentials['password'], $user[0]->password)){
            session()->forget([User::USER_ID, Proxy::PROXY_ID, Camera::CAM_ID, Nvr::NVR_ID]);
            session()->flush();

            session(['USER_ID' => $user[0]->id ]);

            $createLocation = new UserController();
            $createLocation->createLocation($user[0]->id , $request->ip());

            return ApiResponse::ok('Login success');
        }else{
            return ApiResponse::notfound('Login false');
        }
    }

    public function apiLoginProxy(Request $request){
        $proxyId = $request->id;
        $proxyMasterKey = $request->masterkey;
        $proxyPass = $request->password;
        $proxy = Proxy::getById($proxyId);
        if(is_null($proxy)){
            return ApiResponse::notfound('Proxy not found');
        }
        // return \response('ok')->cookie("PROXY_ID", $proxyId);
        if(is_null($proxyPass)){
            //Login use master key
            if(is_null($proxyMasterKey)){
                return ApiResponse::notfound("Login failure");
            }else if($proxyMasterKey == $proxy->masterkey){
                session()->forget([User::USER_ID, Proxy::PROXY_ID, Camera::CAM_ID, Nvr::NVR_ID]);
                session()->flush();
                session(['PROXY_ID'=>$proxyId]);
                return ApiResponse::ok('Login success');            
            }
        }else{
            //Login by passs
            if(Hash::check($proxyPass, $proxy->password)){
                session()->forget([User::USER_ID, Proxy::PROXY_ID, Camera::CAM_ID, Nvr::NVR_ID]);
                session()->flush();
                session(['PROXY_ID'=>$proxyId]);
                return ApiResponse::ok('Login success');
            }else{
                return ApiResponse::notfound("Login failure");
            }
        }
    }

    public function apiLoginNvr(Request $request){
        $nvrId = $request->id;
        $nvrMasterKey = $request->masterkey;
        $nvrPass = $request->password;
        $nvr = Nvr::getById($nvrId);

        if(is_null($nvr)){
            return ApiResponse::notfound('NVR not found');
        }

        // return \response('ok')->cookie("PROXY_ID", $proxyId);
        if(is_null($nvrPass)){
            //Login use master key
            if(is_null($nvrMasterKey)){
                return ApiResponse::notfound("Login failure");
            }else if($nvrMasterKey == $nvr->masterkey){
                session()->forget([User::USER_ID, Proxy::PROXY_ID, Camera::CAM_ID, Nvr::NVR_ID]);
                session()->flush();
                session(['NVR_ID'=>$nvrId]);
                return ApiResponse::ok('Login success');            
            }
        }else{
            //Login by passs
            if(Hash::check($nvrPass, $nvr->password)){
                session()->forget([User::USER_ID, Proxy::PROXY_ID, Camera::CAM_ID, Nvr::NVR_ID]);
                session()->flush();
                session(['PROXY_ID'=>$nvrId]);
                return ApiResponse::ok('Login success');
            }else{
                return ApiResponse::notfound("Login failure");
            }
        }
    }

    public function apiLoginCamera(Request $request){
        $cameraId =  $request->id;
        $cameraPassWord = $request->password;
        $camera = Camera::getById($cameraId);
        if(is_null($camera)){
            return ApiResponse::notfound("Camera not found");
        }

        if($camera->login_pass == $cameraPassWord){
            session()->forget([User::USER_ID, Proxy::PROXY_ID, Camera::CAM_ID, Nvr::NVR_ID]);
            session()->flush();
            session([Camera::CAM_ID => $cameraId]);
            return ApiResponse::ok('Login success');
        }else{
            return ApiResponse::notfound('Password not found');
        }
    }

    public function apiLogout(){
        session()->forget([User::USER_ID, Proxy::PROXY_ID, Camera::CAM_ID, Nvr::NVR_ID]);
        session()->flush();
        return "Loged out";
    }

    public function getAuthId(){
        return session()->all();
        // return session('USER_ID');
    }
}

