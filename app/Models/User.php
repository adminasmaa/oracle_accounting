<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'address',
        'avatar',
        'balance',
        'job',
        'section',
        'id_number',
        'bank_name',
        'bank_account_number',
        'salary',
        'password',
    ];

    protected $appends = ['total_price'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function invoice_items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function invoice_discounts()
    {
        return $this->hasMany(InvoiceDiscount::class);
    }

    public function arrest_receipts()
    {
        return $this->hasMany(ArrestReceipt::class);
    }

    public function payrolls()
    {
        return $this->hasMany(PayrollItem::class);
    }

    public function getTotalPriceAttribute()
    {
        $buy_amount = $this->invoices()->where('type',0)->sum('total_price');
        $buy_references = $this->invoices()->where('type',2)->sum('total_price');
        $sell_amount = $this->invoices()->where('type',1)->sum('total_price');
        $sell_references = $this->invoices()->where('type',3)->sum('total_price');
        $out_amount = $this->arrest_receipts()->where('type',1)->sum('advance');
        $in_amount = $this->arrest_receipts()->where('type',0)->sum('advance');
        $expenses = $this->arrest_receipts()->where('type',3)->sum('advance');
        $revenues = $this->arrest_receipts()->where('type',4)->sum('advance');

        return   ($sell_amount-$buy_amount-$expenses-$sell_references)+($out_amount-$in_amount-$revenues-$buy_references);
    }

}
