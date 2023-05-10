<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function index()
    {
        return view('requests.index');
    }
    public function create()
    {
        return view('requests.create');
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'amount'=>'required|numeric'
        ]);
        $input['user_id'] = Auth::user()->id;
        $input['state'] = 'pending';
        $input['request_serial'] = mt_rand(10000000000000, 99999999999999);
        ModelsRequest::create($input);
        if (Auth::user()->role_id == 1) {
            return redirect(route('requests.index'))->with(['success' => 'Request Successfully Created']);
        } else {
            return redirect(route('user.requests.index'))->with(['success' => 'Request Successfully Created']);
        }

    }
    public function approve(Request $request, $id)
    {
        $user_request = ModelsRequest::find($id);
        $user_request->update([
            'state' => 'approved'
        ]);
        $user = User::find($user_request->user_id);
        $user->update([
            'wallet' => $user->wallet + $user_request->amount
        ]);
        return redirect(route('requests.index'))->with(['success' => 'Request Approved Successfully']);
    }
    public function decline(Request $request, $id)
    {
        $user_request = ModelsRequest::find($id);
        $user_request->update([
            'state' => 'declined'
        ]);
        return redirect(route('requests.index'))->with(['success' => 'Requested Declined Successfully']);
    }
}
