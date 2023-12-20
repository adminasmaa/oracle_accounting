<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndexAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'account_number', 'account_name', 'index_account_id', 'balance', 'basic', 'account_guide_id', 'nature_account'
    ];

    public function parent()
    {
        return $this->belongsTo(IndexAccount::class, 'index_account_id', 'id');
    }

    public function account_guide()
    {
        return $this->belongsTo(AccountGuide::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'index_account_id');
    }

    public function arrest_receipts()
    {
        return $this->hasMany(ArrestReceipt::class, 'index_account_id');
    }


    public function invoice_items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function index_accounts()
    {
        return $this->hasMany(IndexAccount::class);
    }


    static function basicList($basic = false)
    {
        $array = [
            0 => 'غير محدد',
            1 => 'فواتير البيع',
            2 => 'فواتير الشراء',
        ];

        if ($basic === false) {
            return $array;
        }

        if (!is_string($basic) and $basic != false or $basic >= 0) {
            return !empty($array[$basic]) ? $array[$basic] : $basic;
        }
        return $array;
    }

    /**
     * Get the value of total_index
     */
    public function getTotal_index()
    {
        return $this->total_index;
    }

    /**
     * Set the value of total_index
     *
     * @return  self
     */
    public function setTotal_index($total_index)
    {
        $this->total_index = $total_index;

        return $this;
    }


    public function getTotalPriceAttribute()
    {
        $setting = Setting::find(1);

        $total = 0;
        foreach ($this->index_accounts as $index_account) {
            $total = $total + $index_account->total_price;
        }

        $payment_amount = $this->invoices()->where('index_account_id', $this->id)->whereIn('type', [0, 3])->sum('sub_total');
        $in_amount = $this->arrest_receipts()->where('index_account_id', $this->id)->whereIn('type', [1, 2])->sum('advance');

        $purchasing_amount = $this->invoices()->where('index_account_id', $this->id)->whereIn('type', [1, 2, 4])->sum('sub_total');
        $out_amount = $this->arrest_receipts()->where('index_account_id', $this->id)->whereIn('type', [0, 3])->sum('advance');

        $total = ($total - $purchasing_amount - $out_amount + $payment_amount + $in_amount);


        if ($this->id == $setting->allowed_discount_account_index_id) {
            $total = $total + InvoiceDiscount::whereHas('invoice', function ($q) {
                    return $q->where('type', 0);
                })->sum('discount_quantity');
        }

        if ($this->id == $setting->discount_earned_account_index_id) {
            $total = $total + InvoiceDiscount::whereHas('invoice', function ($q) {
                    return $q->where('type', 1);
                })->sum('discount_quantity');
        }
//
//        if ($this->id == $setting->customers_account_index_id) {
//            $total_customer = 0;
//            foreach (User::role(3)->get() as $user) {
//                $total_customer = $user->total_price;
//            }
//            $total = $total + $total_customer;
//        }
//
//        if ($this->id == $setting->salary_account_index_id) {
//            $total_customer = 0;
//            foreach (User::role(4)->get() as $user) {
//                $total_customer = $user->total_price;
//            }
//            $total = $total + $total_customer;
//        }
//
//        if ($this->id == $setting->suppliers_account_index_id) {
//            $total_supplier = 0;
//            foreach (User::role(2)->get() as $user) {
//                $total_supplier = $user->total_price;
//            }
//            $total = $total + $total_supplier;
//        }

        return $total;

    }

}
