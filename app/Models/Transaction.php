<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
                            'user_id',
                            'city_id',
                            'contact_method_id',
                            'payment_method_id',
                            'transaction_type_id',
                            'cost',
                            'description',
                            'contact_info',
                            'property_area',
                            'property_rooms',
                            'property_status',
                            'property_address',
                            'transaction_status',
                            'note'
                            ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function transactionType(){
        return $this->belongsTo(TransactionType::class);
    }
    public function contactMethod(){
        return $this->belongsTo(ContactMethod::class);
    }
    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }
    public function attachments(){
        return $this->hasMany(Attachment::class);
    }
}
