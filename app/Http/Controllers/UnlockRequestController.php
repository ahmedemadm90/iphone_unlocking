<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\UnlockRequest;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnlockRequestController extends Controller
{
    public function index()
    {
        return view('unlock_requests.index');
    }
    public function create()
    {
        return view('unlock_requests.create');
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $user = Auth::user();
        $request->validate([
            'device_id' => 'required|exists:devices,id',
            'device_serial' => 'required'
        ]);
        $serial = $request->device_serial;
        $client = new Client();
        $response = $client->get('https://di-api.reincubate.com/v1/apple-serials/' . $serial . '/?_gl=1*1n1cmmb*_ga*MTUzMjE2MTU3MC4xNjgxNzY5NzYx*_ga_WZ4DCKE2NC*MTY4MTc2OTc2MS4xLjEuMTY4MTc2OTc5Mi4yOS4wLjA.&_ga=2.141954939.8186145.1681769761-1532161570.1681769761');
        $status = $response->getStatusCode();
        // Get the body of the response
        $body = $response->getBody()->getContents();

        // You can then use the $status and $body variables to process the response as needed
        // For example, you can parse the JSON response using Laravel's built-in json_decode() function
        $data = json_decode($body, true);
        $phoneType = $data['configurationCode']['skuHint'];
        $isDevice = Device::where('device_name', 'like', "%$phoneType%")->first();
        if ($isDevice != null) {
            if ($user->wallet - $isDevice->unlock_cost >= 0) {
                $input['user_id'] = $user->id;
                $input['device_id'] = $isDevice->id;
                $input['device_serial'] = $request->serial;
                $input['state'] = 'approved';
                $input['unlock_request_cost'] = $isDevice->unlock_cost;
                UnlockRequest::create($input);
                $user->update([
                    'wallet' => $user->wallet - $isDevice->unlock_cost,
                ]);
                if (Auth::user()->role_id == 1) {
                    return redirect(route('requests.index'))->with(['success' => 'Request Successfully Created']);
                } else {
                    return redirect(route('user.unlock.requests.index'))->with(['success' => 'Request Successfully Created']);
                }
            } else {
                if (Auth::user()->role_id == 1) {
                    return redirect(route('requests.index'))->with(['error' => 'Please Recharge Your Account']);
                } else {
                    return redirect(route('user.unlock.requests.index'))->with(['error' => 'Please Recharge Your Account']);
                }
            }
        } else {
            if (Auth::user()->role_id == 1) {
                return redirect(route('requests.index'))->with(['error' => 'This Serial Number Is Not On Our Devices List']);
            } else {
                return redirect(route('user.unlock.requests.index'))->with(['error' => 'This Serial Number Is Not On Our Devices List']);
            }
        }








        return response()->json($data, $status);
        $device = Device::find($request->device_id);
        $input['user_id'] = Auth::user()->id;
        $input['state'] = 'approved';
        $input['unlock_request_cost'] = $device->unlock_cost;
        if (Auth::user()->wallet >= $input['unlock_request_cost']) {
            UnlockRequest::create($input);
            $user->update([
                'wallet' => $user->wallet - $device->unlock_cost,
            ]);
            return redirect(route('unlock.requests.index'))->with(['success' => 'Unlocking Request Successfully Created']);
        } else {
            return redirect(route('unlock.requests.index'))->with(['error' => 'Please Recharge Your Account, Then Try again']);
        }
    }
    public function approve($id)
    {
        $user_request = UnlockRequest::find($id);
        $user_request->update([
            'state' => 'approved'
        ]);
        if (Auth::user()->role_id == 1) {
            return redirect(route('unlock.requests.index'))->with(['success' => 'Request Approved Successfully']);
        } else {
            return redirect(route('user.unlock.requests.index'))->with(['success' => 'Request Approved Successfully']);
        }
    }
    public function decline(Request $request, $id)
    {
        $user_request = UnlockRequest::find($id);
        $user_request->update([
            'state' => 'declined'
        ]);
        $user = User::find($user_request->user_id);
        $user->update([
            'wallet' => $user->wallet + $user_request->unlock_request_cost
        ]);
        return redirect(route('unlock.requests.index'))->with(['success' => 'Requested Declined Successfully']);
    }
}
