<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormulaBazin extends Model
{
    use HasFactory;

    protected $table = 'formula_bazin';
    protected $fillable = [
        'user_id',
        'dpa',
        'dividend_yield',
    ];

    public function formulaBazin()
    {
        return $this->hasMany(FormulaBazin::class);
    }
}
