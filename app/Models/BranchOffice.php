<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class BranchOffice extends Model
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
        'name',
        'address',
    ];

    /**
     * Get all employees of one branch office
     *
     * @return HasOneOrMany
     */
    public function employees(): HasOneOrMany
    {
        return $this->hasMany(Employee::class, 'branch_office_id');
    }

    /**
     * Get the products associated with the branch office
     *
     * @return MorphToMany
     */
    public function products(): MorphToMany
    {
        return $this->morphToMany(Product::class, 'branch_office', 'product_id');
    }
}
