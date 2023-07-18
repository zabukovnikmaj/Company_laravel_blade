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

    public $incrementing = false;
    public $keyType = 'string';
    protected $primaryKey = 'uuid';
    protected $fillable = [
        'name',
        'description',
        'price',
        'date',
        'fileType'
    ];

    public function branchOffice()
    {
        return $this->belongsToMany(BranchOffice::class, 'BranchOfficeProduct', 'productId', 'branchOfficeId');
    }
}
