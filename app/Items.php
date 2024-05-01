<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Items extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name', 'item_description', 'quantity','price','product_weight','low_stock_margin','sensor_id'
    ];

    public function stockOrders(): HasMany
    {
        return $this->hasMany(StockOrders::class,'item_id');
    }
    public function receivedStockOrders()
    {
        return $this->hasMany(StockOrders::class,'item_id')->where('state', 'received');
    }
}
