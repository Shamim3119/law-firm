<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{

    protected $fillable = [
                            'name', 
                            'address', 
                            'phone', 
                            'email', 
                            'web',
                            'logo',
                        ];

    
    public function accountInfos()
    {
        return $this->hasMany(AccountInfo::class, 'ref_id', 'id')
                ->where('ref_type_id', 3);
    }
 
    public function getAccountCountAttribute()
    {
        return $this->accountInfos()->count();
    }
}
