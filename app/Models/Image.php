<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'phone_details_id',
        'file_path'
    ];
    public $timestamps = false;
    protected $table = 'image';
    protected $primaryKey = 'image_id';
}
