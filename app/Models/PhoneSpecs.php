<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Phone;
use App\Models\PhoneDetails;

class PhoneSpecs extends Model
{
    protected $table = 'phone_specifics';
    protected $primaryKey = 'specific_id';
    protected $fillable = [
        'specific_name'
    ];
    public $timestamps = false;

    public function parentPhone() {
        return $this->belongsTo(Phone::class, 'phone_id', 'phone_id');
    }

    public function PhoneDetails() {
        return $this->hasMany(PhoneDetails::class, 'specific_id', 'specific_id');
    }

    // Return all the available colors of a detail that have parent is this specs.
    public function detailsColorsOfThisSpecs() {
        $details = PhoneDetails::where('phone_details.specific_id', '=', $this->specific_id)->join('phone_colors', 'phone_details.color_id', '=', 'phone_colors.color_id')->get();
        return $details;
    }
}
