<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PhoneSpecs;
use App\Models\Color;

class PhoneDetails extends Model
{
    protected $table = 'phone_details';
    protected $primaryKey = 'phone_details_id';
    public $timestamps = false;
    public function parentPhone() {
        return $this->belongsTo(Phone::class, 'phone_id', 'phone_id');
    }

    public function parentColor() {
        return $this->belongsTo(Color::class, 'color_id', 'color_id');
    }

    public function parentSpecific() {
        return $this->belongsTo(PhoneSpecs::class, 'specific_id', 'specific_id');
    }

    public function siblingsWithColors() {
        $siblings = PhoneDetails::where('phone_details.phone_id', '=', $this->phone_id)->join('phone_colors', 'phone_details.color_id', '=', 'phone_colors.color_id')->get();
        return $siblings;
    }
}
