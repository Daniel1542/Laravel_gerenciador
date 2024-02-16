@extends('layouts.maindashboard')
@section('title','Ativos')
@section('content')

  <section class='secao_mostrar'>
    <div class="container" id="caixa">
      <div class="row justify-content-center">
        <div class="col-md-6 text-center">
          <h1 class="mt-2" style="margin-bottom:20px;">Ativos</h1>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
          <tr>   
            <th class="opcoes-a">Ação:</th>
            <th class="opcoes-a">Movimento</th>   
            <th class="opcoes-a">Quantidade: </th>
            <th class="opcoes-a">Valor: </th>       
            <th class="opcoes-a">Corretagem: </th>
            <th class="opcoes-a">Data: </th>        
          </tr>
          </thead>
          @foreach($dadosAtivos as $acao)         
            <tr>
              <td> {{ $acao['nome'] }}</td>
              <td> {{ $acao['movimento'] }}</td> 
              <td> {{ $acao['quantidade']}}</td>         
              <td> {{ $acao['valor'] }}</td>
              <td> {{ $acao['corretagem'] }}</td> 
              <td> {{ $acao['data']}}</td>                     
            </tr> 
          @endforeach    
        </table>
      </div>
    </div>
  </section>
@endsection