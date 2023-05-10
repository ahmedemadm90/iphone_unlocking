<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $fillable = ['amount','user_id', 'state', 'request_serial'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
