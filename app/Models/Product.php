<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
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
        'name',
        'description',
        'price',
        'date',
        'fileType'
    ];

    /**
     * Gets branch office associated with product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function branchOffice()
    {
        return $this->belongsToMany(BranchOffice::class, 'BranchOfficeProduct', 'productId', 'branchOfficeId');
    }
}
