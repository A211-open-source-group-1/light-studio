<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'review_id',
        'phone_details_id',
        'user_id',
        'content',
        'rating'
    ];
    
    protected $table = 'review';
    protected $primaryKey = 'review_id';
    public $timestamps = false;

    public function parentUser() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function parentPhoneDetails() {
        return $this->belongsTo(PhoneDetails::class, 'phone_details_id', 'phone_details_id');
    }

}
