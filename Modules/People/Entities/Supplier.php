<?php

namespace Modules\People\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Purchase\Entities\Purchase;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'supplier_id', 'id');
    }
    protected static function newFactory() {
        return \Modules\People\Database\factories\SupplierFactory::new();
    }
}
