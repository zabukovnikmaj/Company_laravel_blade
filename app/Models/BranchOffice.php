<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class BranchOffice extends Model
{
    use HasUuids;
    use HasFactory;

    /**
     * Specifies table name
     *
     * @var string
     */
    public $table = 'branchOffice';

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
        'address',
    ];

    /**
     * Get all employees of one branch office
     *
     * @return HasMany
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    /**
     * Get the products associated with the branch office
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'BranchOfficeProduct', 'branch_office_uuid', 'product_uuid');
    }
}
