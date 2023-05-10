<?php

use App\Http\Controllers\Api\AuthController;
use App\Models\Device;
use App\Models\UnlockRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'loginUser']);
Route::get('/migrate', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    Artisan::call('migrate:fresh --seed');
    return 'app cleared';
});
Route::post('/unlock', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
        'serial' => 'required|string',
    ]);
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $user = auth()->user();
        //$token = $user->createToken("Auth Token")->plainTextToken;
        $client = new Client();
        $serial = $request->serial;
        $response = $client->get('https://di-api.reincubate.com/v1/apple-serials/' . $serial . '/?_gl=1*1n1cmmb*_ga*MTUzMjE2MTU3MC4xNjgxNzY5NzYx*_ga_WZ4DCKE2NC*MTY4MTc2OTc2MS4xLjEuMTY4MTc2OTc5Mi4yOS4wLjA.&_ga=2.141954939.8186145.1681769761-1532161570.1681769761');
        $statusCode = $response->getStatusCode();
        if ($statusCode == 200) {
            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);
            $phoneType = $data['configurationCode']['skuHint'];
            $isDevice = Device::where('device_name', 'like', "%$phoneType%")->first();
            if($isDevice != null){
                if($user->wallet - $isDevice->unlock_cost >= 0){
                    $input['user_id'] = $user->id;
                    $input['device_id'] = $isDevice->id;
                    $input['device_serial'] = $request->serial;
                    $input['state'] = 'approved';
                    $input['unlock_request_cost'] = $isDevice->unlock_cost;
                    UnlockRequest::create($input);
                    $user->update([
                        'wallet' => $user->wallet - $isDevice->unlock_cost,
                    ]);
                    $arr = [
                        'code' => 200,
                        'state' => true,
                        'data' => 'Request Is Now Approved'
                    ];
                    return response()->json($arr);
                }else{
                    $arr = [
                        'code' => 302,
                        'state' => false,
                        'data' => 'Please Recharge Your Account, and Try again Later'
                    ];
                    return response()->json($arr);
                }
            }else{
                $arr = [
                    'code' => 302,
                    'state' => false,
                    'data' => 'This Device In Not On Our List'
                ];
                return response()->json($arr);
            }
        }
    } else {
        $arr = [
            'code' => 302,
            'state' => 'False',
            'data' => 'Invaled Credintials'
        ];
        return response()->json($arr);
    }
});
