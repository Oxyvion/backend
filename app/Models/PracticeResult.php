<?php

namespace App\Models;

use Database\Factories\PracticeResultFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PracticeResult extends Model
{
    /** @use HasFactory<PracticeResultFactory> */
    use HasFactory;

    // Estos datos se guardan después de validarlos y calcularlos en el controlador.
    protected $fillable = [
        'user_id',
        'exercise_id',
        'typed_text',
        'elapsed_seconds',
        'ppm',
        'accuracy',
        'errors',
        'characters_typed',
    ];

    protected function casts(): array
    {
        return ['accuracy' => 'decimal:2'];
    }

    /** El resultado pertenece a una cuenta; así se filtra el historial privado. */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** El resultado guarda una referencia al ejercicio realizado. */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
}
