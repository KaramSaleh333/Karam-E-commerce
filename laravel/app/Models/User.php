<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'email',
        'password',
    ];

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function products(){
        return $this->hasMany(Products::class , 'user_id');
    }
    public function products_cart(){
        return $this->belongsToMany(Products::class , 'carts')->withPivot('id' , 'amount');
    }
    public function products_payment(){
        return $this->belongsToMany(Products::class , 'payments')
        ->withPivot('id' , 'InvoiceDisplayValue' , 'amount' , 'TransactionStatus' ,
        'CardNumber' , 'PaymentId' ,'product_name' , 'product_image_path');;
    }
}
