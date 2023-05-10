<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        return view('devices.index');
    }
    public function create()
    {
        return view('devices.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'device_name'=>'required|unique:devices,device_name',
            'unlock_cost'=>'required|numeric'
        ]);
        Device::create($request->all());
        return redirect(route('devices.index'))->with(['success'=>'New Device Was Added TO Your List Successfully']);
    }
    public function edit($id)
    {
        $device = Device::find($id);
        return view('devices.edit',compact('device'));
    }
    public function update(Request $request,$id)
    {
        $device = Device::find($id);
        $request->validate([
            'device_name' => 'required|unique:devices,device_name,'.$id,
            'unlock_cost' => 'required|numeric'
        ]);
        $device->update($request->all());
        return redirect(route('devices.index'))->with(['success' => 'Your Device Updated Successfully']);
    }
}
