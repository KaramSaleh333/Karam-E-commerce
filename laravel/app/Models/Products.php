<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'product_details',
        'product_type',
        'amount',
        'product_image_path',
        'user_id',
        'price',
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function users_cart(){
        return $this->belongsToMany(User::class , 'carts')->withPivot('id' , 'amount');
    }
    public function users_payment(){
        return $this->belongsToMany(User::class , 'payments')
        ->withPivot('id' , 'InvoiceDisplayValue' ,'amount' , 'TransactionStatus' ,
        'CardNumber , PaymentId' , 'product_name' , 'product_image_path');
    }

}
