<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Consultation extends Model
{
    use HasFactory;

    protected $table = 'consultations';

    protected $fillable = [
     
        'pet_id',
        'vet_id',
        'the_date',
        'total_cost'
        
    
        ];

        public function procedures(): BelongsToMany
        {
            return $this->belongsToMany(Procedure::class,'consultations_procedures','consultation_id' ,'procedure_id');
    
            
        }

        public function pet(): BelongsTo
        {
            return $this->belongsTo(Pet::class);
        }

        public function vet(): BelongsTo
        {
            return $this->belongsTo(Vet::class);
        }
}
