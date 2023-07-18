<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchOfficeProduct extends Model
{
    use HasUuids;
    use HasFactory;

    public $table = 'branchOfficeProduct';
    public $incrementing = false;
    public $keyType = 'string';
    protected $primaryKey = 'uuid';
    protected $fillable = [
        'branch_office_uuid',
        'product_uuid',
    ];

    public function branchOffice()
    {
        return $this->belongsTo(BranchOffice::class, 'branchOfficeId', 'uuid');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'productId', 'uuid');
    }
}
