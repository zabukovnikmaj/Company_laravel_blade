<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchOfficeProduct extends Model
{
    use HasUuids;
    use HasFactory;

    /**
     * Specifies table name
     *
     * @var string
     */
    public $table = 'branchOfficeProduct';

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
    public $keyType = 'string';

    /**
     * Specifies name of PK
     *
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * Defines fillable parameters
     *
     * @var string[]
     */
    protected $fillable = [
        'branch_office_uuid',
        'product_uuid',
    ];

    /**
     * Get the branch office associated with branch office product table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branchOffice()
    {
        return $this->belongsTo(BranchOffice::class, 'branchOfficeId', 'uuid');
    }

    /**
     * Get the product associated with the branch office product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'productId', 'uuid');
    }
}
