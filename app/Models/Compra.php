<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable = [
        'user_id',
        'produto_id',
        'quantidade',
        'preco_unitario',
        'valor_total',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
