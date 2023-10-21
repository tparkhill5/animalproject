<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'animal_type_id',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(AnimalType::class, 'animal_type_id');
    }

    public function getTypeNameAttribute(): string
    {
        return $this->type->name;
    }

    public function getIsImaginaryAttribute(): bool
    {
        return $this->type->is_imaginary;
    }

    public function getSaysAttribute(): ?string
    {
        return $this->type->sound;
    }
}
