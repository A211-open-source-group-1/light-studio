<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneCategory extends Model
{
    protected $table = 'phone_category';
    protected $primaryKey = 'category_id';
    public $timestamps = false;
    public function Phones()
    {
        return $this->hasMany(Phone::class, 'category_id', 'category_id');
    }
}
