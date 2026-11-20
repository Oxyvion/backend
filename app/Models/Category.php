<?php

namespace App\Models;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<CategoryFactory> */
    use HasFactory;

    // Laravel solo permite asignar en masa el nombre validado por CategoryRequest.
    protected $fillable = ['name'];

    /** La relación uno-a-muchos permite consultar ejercicios de esta categoría. */
    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class);
    }
}
