<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportReceipt extends Model
{
    protected $fillable = [
        'provider_name',
        'contact_name',
        'phone_number',
        'receipt_status',
        'payment_status',
        'user_id',
        'created_at',
        'updated_at'
    ];
    protected $table = 'import_receipts';
    protected $primaryKey = 'id';

    public function ImportReceiptDetails()
    {
        return $this->hasMany(ImportReceiptDetails::class, 'import_receipt_id', 'id');
    }
}
