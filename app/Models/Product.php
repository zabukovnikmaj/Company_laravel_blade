<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasUuids;
    use HasFactory;

    /**
     * Variable that stores filepath to the product image
     *
     * @var string
     */
    public string $filename = '';
    

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
        'name',
        'description',
        'price',
        'date',
        'file_type',
    ];

    /**
     * Gets branch office associated with product
     *
     * @return BelongsToMany
     */
    public function branch_offices(): BelongsToMany
    {
        return $this->belongsToMany(BranchOffice::class, 'branch_office_products', 'product_id', 'branch_office_id');
    }
}
