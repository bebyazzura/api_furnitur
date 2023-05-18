<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Furniture extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'furnitur';

    protected $fillable = [
        'seller', 'name', 'description', 'price', 'image'
    ];

    /**
     * Get the user that owns the Furniture
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller_name(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller', 'id');
    }
}
