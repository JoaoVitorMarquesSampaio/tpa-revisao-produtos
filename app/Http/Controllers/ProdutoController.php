<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    // R1 - Listar produtos
    public function index()
    {
        $produtos = Produto::with('vendedor')
            ->latest()
            ->get();

        return view('produtos.index', compact('produtos'));
    }

    // R5 - Exibir formulário de cadastro
    public function create()
    {
        return view('produtos.create');
    }

    // R5 e R6 - Cadastrar e associar ao vendedor
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'categoria' => ['required', 'string', 'max:255'],
            'garantia_meses' => ['required', 'integer', 'min:0'],
            'preco' => ['required', 'numeric', 'min:0'],
            'estoque' => ['required', 'integer', 'min:0'],
        ]);

        // O vendedor é o usuário autenticado.
        // Não aceitamos vendedor_id enviado pelo formulário.
        $dados['vendedor_id'] = $request->user()->id;

        Produto::create($dados);

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto cadastrado com sucesso!');
    }
}
