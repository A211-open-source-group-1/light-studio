<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportReceiptDetails extends Model
{
    protected $fillable = [
        'import_receipt_id',
        'phone_details_id',
        'import_quantity',
        'price',
        'unit_name',
        'total_price',
        'created_at',
        'updated_at'
    ];
    protected $table = 'import_receipts_details';
    protected $primaryKey = 'id';

    public function ImportReceipt() {
        return $this->belongsTo(ImportReceipt::class, 'import_receipt_id');
    }

    public function PhoneDetails() {
        return $this->belongsTo(PhoneDetails::class, 'phone_details_id', 'phone_details_id');
    }
}
