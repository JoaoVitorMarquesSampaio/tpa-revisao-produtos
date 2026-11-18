<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CompraController extends Controller
{
    // R8 - Histórico de compras
    public function index(Request $request)
    {
        $compras = Compra::with('produto')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return view('compras.index', compact('compras'));
    }

    // R7 - Formulário de compra
    public function create()
    {
        $produtos = Produto::where('estoque', '>', 0)
            ->orderBy('nome')
            ->get();

        return view('compras.create', compact('produtos'));
    }

    // R7 e bônus - Registrar compra e diminuir estoque
    public function store(Request $request)
    {
        $dados = $request->validate([
            'produto_id' => ['required', 'exists:produtos,id'],
            'quantidade' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($request, $dados) {
            $produto = Produto::whereKey($dados['produto_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($produto->estoque < $dados['quantidade']) {
                throw ValidationException::withMessages([
                    'quantidade' => 'Estoque insuficiente para esta compra.',
                ]);
            }

            $precoUnitario = $produto->preco;

            Compra::create([
                'user_id' => $request->user()->id,
                'produto_id' => $produto->id,
                'quantidade' => $dados['quantidade'],
                'preco_unitario' => $precoUnitario,
                'valor_total' => round(
                    (float) $precoUnitario * $dados['quantidade'],
                    2
                ),
            ]);

            $produto->decrement('estoque', $dados['quantidade']);
        });

        return redirect()
            ->route('compras.index')
            ->with('success', 'Compra realizada com sucesso!');
    }
}
