<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
 
class Client extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'code']; 

    public function accountInfos()
    {
        return $this->hasMany(AccountInfo::class, 'ref_id', 'id')
                ->where('ref_type_id', 2);
    }
 
    public function getAccountCountAttribute()
    {
        return $this->accountInfos()->count();
    }
}
