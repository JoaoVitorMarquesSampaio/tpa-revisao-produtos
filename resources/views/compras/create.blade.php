@extends('layouts.app')

@section('title', 'Comprar — Loja de Produtos')

@section('content')
<h2 class="fw-bold mb-3">🛒 Nova compra</h2>

<div class="card shadow-sm p-4">
    <form method="POST" action="{{ route('compras.store') }}">
        @csrf

        <div class="mb-3">
            <label for="produto_id" class="form-label">
                Selecione o produto
            </label>

            <select name="produto_id" id="produto_id"
                    class="form-select @error('produto_id') is-invalid @enderror"
                    required>
                <option value="">Selecione...</option>

                @foreach ($produtos as $produto)
                    <option value="{{ $produto->id }}"
                        @selected(old('produto_id') == $produto->id)>
                        {{ $produto->nome }} -
                        R$ {{ number_format($produto->preco, 2, ',', '.') }}
                        (Estoque: {{ $produto->estoque }})
                    </option>
                @endforeach
            </select>

            @error('produto_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="quantidade" class="form-label">
                Quantidade
            </label>

            <input type="number"
                   name="quantidade"
                   id="quantidade"
                   min="1"
                   value="{{ old('quantidade', 1) }}"
                   class="form-control @error('quantidade') is-invalid @enderror"
                   required>

            @error('quantidade')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary fw-bold">
            Finalizar compra
        </button>
    </form>
</div>
@endsection
