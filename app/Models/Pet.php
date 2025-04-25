<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pet extends Model
{
    use HasFactory;

    protected $table = 'pets';

    protected $fillable = [
     
    'client_id',
    'name',
    'specie', 
    'breed', 
    'color', 
    'height', 
    'weight', 
    'gender',
    'birth_date',
    'father',
    'mother',
    'observations'

    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class);
       
    }

}
