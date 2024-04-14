<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Phone;

class Color extends Model
{
    protected $fillable = [
        'color_name'
    ];
    protected $table = 'phone_colors';
    protected $primaryKey = 'color_id';
    public $timestamps = false;

    public function parentPhone() {
        return $this->belongsTo(Phone::class, 'phone_id', 'phone_id');
    }

    public function PhoneDetails() {
        return $this->hasMany(PhoneDetails::class, 'color_id', 'color_id');
    }
}
