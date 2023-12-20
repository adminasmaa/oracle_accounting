<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Limitation extends Model
{
    use HasFactory, SoftDeletes;

    public $guarded = [];

    public function arrestreceipt()
    {
        return $this->belongsTo(ArrestReceipt::class, 'arrest_receipt_id', 'id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }

    public function invoicediscount()
    {
        return $this->belongsTo(InvoiceDiscount::class, 'invoice_id', 'invoice_id');
    }

    public function arrestreceipts()
    {
        return $this->belongsTo(ArrestReceipt::class, 'invoice_id', 'invoice_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payroll()
    {
        return $this->belongsTo(Payroll::class);
    }
}
