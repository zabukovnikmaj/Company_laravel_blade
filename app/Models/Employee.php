<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
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
        'position',
        'age',
        'sex',
        'email',
        'branch_office',
    ];

    /**
     * Get branch office that employs employee
     *
     * @return BelongsTo
     */
    public function branchOffice(): BelongsTo
    {
        return $this->belongsTo(BranchOffice::class, 'branch_office', 'uuid');
    }
}
