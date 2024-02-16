@extends('layouts.maindashboard')
@section('title','Cadastrar')
@section('content')

  <section class='secao_acoes'>
    <div class="container" id="cima">
      <div class="row justify-content-left">
        <div class="col-md-6 text-left">
            <h1 class="mt-4">Cadastrar</h1>
        </div>
      </div>
      <!-- Formulário de Cadastro -->
      <div class="container" id="caixa">
        <form action="{{ route('ativos.store') }}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="tipo">Tipo de ativo:</label>
            <select id="tipo" name="tipo" required>
                <option value="fundo imobiliario">fundo imobiliario</option>
                <option value="acao">acao</option>
            </select>
          </div>
          <div class="form-group">
            <label for="movimento">Tipo de Operação:</label>
            <select id="movimento" name="movimento" required>
                <option value="compra">compra</option>
                <option value="venda">venda</option>
            </select>
          </div>
          <div class="form-group">
            <label for="nome">Ativo:</label>
            <input type="text" id="nome" name="nome" required>
          </div>
          <div class="form-group">
            <label for="data">Data:</label>
            <input type="date" id="data" name="data" required>
          </div>
          <div class="form-group"> 
            <label for="corretagem">Corretagem:</label>
            <input type="number" id="corretagem" name="corretagem" required>
          </div>
          <div class="form-group"> 
            <label for="quantidade">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" required>
          </div>
          <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="number" step="0.01" id="valor" name="valor" required>
          </div>
          <div class="form-group" style="margin-top: 15px;">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </div>  
        </form>
      </div>   
    </div>
  </section>

@endsection