<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class
StockOrders extends Model
{
    use HasFactory;

    protected $fillable = ['reference_id', 'vendor_id', 'note', 'expected_date', 'created_by', 'state','item_id','price','order_quantity','received_quantity','received_date'];

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Items::class, 'stock_order_items');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(customers::class, 'vendor_id', 'id');
    }

    public function getTotalReceivedQuantity(): float
    {
        return $this->where('id', $this->id)
            ->where('state', 'received')
            ->sum('received_quantity');
    }
}
