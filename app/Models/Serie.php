<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Serie extends Model
{
    protected $fillable = ["nome", "capa"];

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }

    public function getCapaUrlAttribute(): string
    {
        return ($this->capa !== null) ? Storage::url($this->capa) : Storage::url('series/sem-imagem.jpg');
    }
}