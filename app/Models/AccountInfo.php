<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Parameter;
use App\Models\BankOperator;

class AccountInfo extends Model
{
    protected $fillable = ['title', 
                            'bank_id', 
                            'ref_id', 
                            'ref_type_id', 
                            'type_id',
                            'code',
                            'account_no', 
                            'name', 
                            'description', 
                            'inactive',
                            ]; 


    public function bank()
    {
        return $this->belongsTo(BankOperator::class, 'bank_id');
    }

    public function type()
    {
        return $this->belongsTo(Parameter::class, 'type_id');
    }

 
}
