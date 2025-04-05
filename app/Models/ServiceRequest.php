<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'category', 'description', 'is_urgent'
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
