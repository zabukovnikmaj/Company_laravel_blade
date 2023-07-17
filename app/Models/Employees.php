<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employees extends Model
{
    use HasUuids;
    use HasFactory;

    public $incrementing = false;
    public $keyType = 'string';
    protected $primaryKey = 'uuid';

    /**
     * Get branch office that employs employee
     *
     * @return BelongsTo
     */
    public function branchOffice(): BelongsTo
    {
        return $this->belongsTo(BranchOffice::class);
    }
}
