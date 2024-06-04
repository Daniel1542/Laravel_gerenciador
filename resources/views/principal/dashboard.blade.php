@extends('layouts.mainDashboard')
@section('title', 'Dashboard')
@section('content')

<section class="secao_dash">
    <div id="caixa">
        <div class="container">
            <div class="card">   
                <div class="card-body">
                    <h5 class="card-title">Quantidade Ações:</h5>
                    @if ($acoesCount > 0)
                        <p class="font">{{ $acoesCount }}</p>
                    @endif                                                           
                </div>
            </div>
            <div class="card">                      
                <div class="card-body">                  
                    <h5 class="card-title">Quantidade FIIs:</h5>
                    @if ($fiisCount > 0)
                        <p class="font" >{{ $fiisCount }}</p>
                    @endif                                  
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card">   
                <div class="card-body">
                    <h5 class="card-title">Porcentagem Ações:</h5>
                    @if ($acoesPercent > 0)
                        <p class="font">{{ number_format($acoesPercent, 2, ',', '.') }}%</p>
                    @endif                                                          
                </div>
            </div>
            <div class="card">   
                <div class="card-body">
                    <h5 class="card-title">Porcentagem Fiis:</h5>
                    @if ($fiisPercent > 0)
                        <p class="font">{{ number_format($fiisPercent, 2, ',', '.') }}%</p>
                    @endif                                                        
                </div>
            </div>
        </div>
    </div>
</section>
<section class="secao_dash2">
    {{-- Vue de graficos de pizza --}}
    <div id="app">
        <Dash></Dash>
    </div>
</section>

<script src="js/dash_graficos.js"></script>
  
@endsection
