<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vet extends Model
{
    use HasFactory;

    protected $table = 'vets';

    protected $fillable = [

        'name',
        'email',
        'cell_phone',
        'address',
        'state'
    ];

    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class);
       
    }
}
