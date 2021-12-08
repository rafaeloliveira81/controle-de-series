<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Serie extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['nome', 'categoria', 'streaming', 'status'];

    public function temporada(): HasMany
    {
        return $this->HasMany(Temporada::class);
    }
}
