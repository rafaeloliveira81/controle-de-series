<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Serie extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'categoria', 'streaming', 'status'];

    public function temporadas(): HasMany
    {
        return $this->HasMany(Temporada::class);
    }
}
