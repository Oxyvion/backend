<?php

namespace App\Models;

use Database\Factories\ExerciseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exercise extends Model
{
    /** @use HasFactory<ExerciseFactory> */
    use HasFactory;

    // Solo estos campos pueden cambiar desde los formularios del CRUD.
    protected $fillable = ['title', 'category_id', 'difficulty', 'content'];

    /** Cada ejercicio pertenece a una categoría. */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /** Un ejercicio puede aparecer en muchos resultados de práctica. */
    public function practiceResults(): HasMany
    {
        return $this->hasMany(PracticeResult::class);
    }
}
