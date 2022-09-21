<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_shriram extends Model
{
    use HasFactory;
    protected $fillable=['name','mobile','desc','estri','ring','pendri','order_date','delivery_date','shirt_qty','paint_qty','total_amt','advance_amt'];
}
