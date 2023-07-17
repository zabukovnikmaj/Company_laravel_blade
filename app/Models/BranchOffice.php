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

    public $incrementing = false;
    public $keyType = 'string';
    protected $primaryKey = 'uuid';

    /**
     * Get all employees of one branch office
     *
     * @return HasMany
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employees::class);
    }

    public function products(): MorphToMany {
        return $this->morphToMany(Products::class, 'branchOfficeProduct');
    }
}
