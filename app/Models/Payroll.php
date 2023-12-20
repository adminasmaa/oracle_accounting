<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payroll extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date',
        'description'
        // 'user_id', 'advance'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payroll_items()
    {
        return $this->hasMany(PayrollItem::class);
    }

}
