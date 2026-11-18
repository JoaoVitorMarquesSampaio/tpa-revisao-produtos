@extends('layouts.app')

@section('title', 'Cadastrar Produto — Loja de Produtos')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm p-4">
            <h3 class="fw-bold mb-3">➕ Cadastrar Produto</h3>

            <form method="POST" action="{{ route('produtos.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome"
                           value="{{ old('nome') }}"
                           class="form-control @error('nome') is-invalid @enderror"
                           required>
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoria</label>
                    <select name="categoria" id="categoria"
                            class="form-select @error('categoria') is-invalid @enderror"
                            required>
                        <option value="">Selecione...</option>
                        <option value="Eletrônicos" @selected(old('categoria') == 'Eletrônicos')>Eletrônicos</option>
                        <option value="Vestuário" @selected(old('categoria') == 'Vestuário')>Vestuário</option>
                        <option value="Casa" @selected(old('categoria') == 'Casa')>Casa</option>
                        <option value="Alimentos" @selected(old('categoria') == 'Alimentos')>Alimentos</option>
                    </select>
                    @error('categoria')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="garantia_meses" class="form-label">Garantia (meses)</label>
                    <input type="number" name="garantia_meses" id="garantia_meses"
                           min="0" value="{{ old('garantia_meses') }}"
                           class="form-control @error('garantia_meses') is-invalid @enderror"
                           required>
                    @error('garantia_meses')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="preco" class="form-label">Preço (R$)</label>
                    <input type="number" name="preco" id="preco"
                           step="0.01" min="0" value="{{ old('preco') }}"
                           class="form-control @error('preco') is-invalid @enderror"
                           required>
                    @error('preco')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="estoque" class="form-label">Estoque</label>
                    <input type="number" name="estoque" id="estoque"
                           min="0" value="{{ old('estoque') }}"
                           class="form-control @error('estoque') is-invalid @enderror"
                           required>
                    @error('estoque')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-bold">
                    Cadastrar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
