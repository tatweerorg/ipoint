<?php

namespace Modules\People\Entities;

use Modules\Sale\Entities\Sale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{

    use HasFactory;

    protected $guarded = [];
    public function sales()
    {
        return $this->hasMany(Sale::class, 'customer_id', 'id');
    }
    protected static function newFactory() {
        return \Modules\People\Database\factories\CustomerFactory::new();
    }
    

}
