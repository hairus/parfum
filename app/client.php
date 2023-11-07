<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    protected $guarded= [];

    public function trxs()
    {
        return $this->hasMany(transaksi::class, 'client_id');
    }

    public function claims()
    {
        return $this->hasMany(claim::class, 'client_id');
    }


}
