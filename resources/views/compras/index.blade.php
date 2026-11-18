@extends('layouts.app')

@section('title', 'Minhas compras — Loja de Produtos')

@section('content')

<h2 class="fw-bold mb-3">🧾 Minhas compras</h2>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@forelse ($compras as $compra)

    <div class="card shadow-sm mb-3">

        <div class="card-header d-flex justify-content-between">
            <strong>Compra #{{ $compra->id }}</strong>

            <span class="text-secondary">
                {{ $compra->created_at->format('d/m/Y H:i') }}
            </span>
        </div>

        <table class="table table-dark mb-0">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço unitário</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>
                        {{ $compra->produto->nome ?? 'Produto indisponível' }}
                    </td>

                    <td>
                        {{ $compra->quantidade }}
                    </td>

                    <td>
                        R$ {{ number_format($compra->preco_unitario, 2, ',', '.') }}
                    </td>

                    <td>
                        R$ {{ number_format($compra->valor_total, 2, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="card-footer text-end fw-bold">
            Total da compra:
            R$ {{ number_format($compra->valor_total, 2, ',', '.') }}
        </div>

    </div>

@empty

    <p class="text-secondary">
        Você ainda não fez nenhuma compra.
    </p>

@endforelse

<a href="{{ route('compras.create') }}"
   class="btn btn-primary mt-3">
    🛒 Fazer nova compra
</a>

@endsection
