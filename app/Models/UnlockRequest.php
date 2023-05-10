<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnlockRequest extends Model
{
    use HasFactory;
    protected $fillable = ['device_id', 'device_serial','user_id', 'unlock_request_cost', 'state'];
    public function device()
    {
        return $this->belongsTo(Device::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
