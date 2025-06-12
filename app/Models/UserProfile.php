<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'profile_image',
        'gender',
        'address',
        'pincode',
        'city',
        'state',
        'nationality',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
