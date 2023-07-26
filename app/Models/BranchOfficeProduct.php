<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class BranchOfficeProduct extends Model
{
    use HasUuids;
    use HasFactory;

    /**
     * PK does not increment
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Specifies PK data type
     *
     * @var string
     */
    public $keyType = 'uuid';

    /**
     * Defines fillable parameters
     *
     * @var string[]
     */
    protected $fillable = [
        'branch_office_id',
        'product_id',
    ];

    /**
     * Get the branch office associated with branch office product table
     *
     * @return BelongsTo
     */
    public function branch_office()
    {
        return $this->belongsTo(BranchOffice::class, 'branch_office_id', 'id');
    }

    /**
     * Get the product associated with the branch office product
     *
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
