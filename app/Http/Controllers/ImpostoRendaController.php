<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimentoAtivos;
use App\Exports\AtivosExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ImpostoRendaController extends Controller
{
    function calcularMovimentos($movimentos) {
        $dados = [];
    
        foreach ($movimentos as $nome => $movimentos) {
            $compras = $movimentos->where('movimento', 'compra');
            $vendas = $movimentos->where('movimento', 'venda');
    
            $quantidadeCompra = $compras->sum('quantidade');
            $quantidadeVenda = $vendas->sum('quantidade');
            $quantidadeTotal = $quantidadeCompra - $quantidadeVenda;
    
            $movimento = $quantidadeTotal > 0 ? 'compra' : 'venda';
    
            $dados[] = [
                'nome' => $nome,
                'compra' => [
                    'quantidadeTotal' => $quantidadeTotal,
                    'total' => $quantidadeCompra > 0 ? $compras->sum('valortotal') : 0,
                ],
                'venda' => [
                    'quantidadeTotal' => $quantidadeVenda,
                    'total' => $quantidadeVenda > 0 ? $vendas->sum('valortotal') : 0,
                ],
            ];
        }
    
        return $dados;
    }

    function calcularMovimentosExcel($movimentosAtivos) {
        $dados = [];
    
        foreach ($movimentosAtivos as $nome => $movimentos) {
            $quantidadeCompraTotal = 0;
            $quantidadeVendaTotal = 0;
            $valorCompraTotal = 0;
            $valorVendaTotal = 0;
            $corretagemTotal = 0;
    
            foreach ($movimentos as $movimento) {
                if ($movimento->movimento === 'compra') {
                    $quantidadeCompraTotal += $movimento->quantidade;
                    $valorCompraTotal += $movimento->valortotal;
                } elseif ($movimento->movimento === 'venda') {
                    $quantidadeVendaTotal += $movimento->quantidade;
                    $valorVendaTotal += $movimento->valortotal;
                }
    
                $corretagemTotal += $movimento->corretagem;
            }

            $quantidadeTotal = $quantidadeCompraTotal - $quantidadeVendaTotal;

            $valorFinal = $valorCompraTotal - $valorVendaTotal + $corretagemTotal;
    
            $dados[] = [
                'nome' => $nome,
                'quantidadeCompra' => $quantidadeCompraTotal > 0 ? $quantidadeCompraTotal : '0',
                'quantidadeVenda' => $quantidadeVendaTotal > 0 ? $quantidadeVendaTotal : '0',
                'quantidadeTotal' => $quantidadeTotal > 0 ? $quantidadeTotal : '0',
                'SomaCorretagem' => $corretagemTotal > 0 ? 'R$ ' . number_format($corretagemTotal, 2, ',', '.') : 'R$ 0,00',
                'valorCompra' => $valorCompraTotal > 0 ? 'R$ ' . number_format($valorCompraTotal, 2, ',', '.') : 'R$ 0,00',
                'valorVenda' => $valorVendaTotal > 0 ? 'R$ ' . number_format($valorVendaTotal, 2, ',', '.') : 'R$ 0,00',
                'valorFinal' => $valorFinal > 0 ? 'R$ ' . number_format($valorFinal, 2, ',', '.') : 'R$ 0,00',
            ];
        }
    
        return $dados;
    }
    
    function opcoes(Request $request){
        $baixar = $request->input('baixar');
        $data = $request->input('data');
      
        $tipo = $request->input('tipo');
        if ( $baixar == 'Excel'){
            return redirect()->route('imposto.exportAtivos', [
                'data_ini' => $data,
                'tip' => $tipo,
            ]);

        }
        else{
            return redirect()->route('imposto.exportIrpdfPdf', [
                'data_ini' => $data,
                'tip' => $tipo,
            ]);
        }
    }
    
    public function index()
    {
        $movimentosAcoes = MovimentoAtivos::where('tipo', 'acao')
            ->whereIn('movimento', ['compra', 'venda'])
            ->get();
    
        $movimentosFiis = MovimentoAtivos::where('tipo', 'fundo imobiliario')
            ->whereIn('movimento', ['compra', 'venda'])
            ->get();
    
        $dadosAtivos = $this->calcularMovimentos($movimentosAcoes->groupBy('nome'));
        $dadosfiis = $this->calcularMovimentos($movimentosFiis->groupBy('nome'));
    
        return view('ir.impostoRenda', compact('dadosAtivos', 'dadosfiis'));
    }

    /* PDF*/

    public function exportIrpdfPdf($data_ini, $tip)
    {
        $data_inicio = $data_ini;
        $tipo = $tip;
        $movimentosAcoes = MovimentoAtivos::where('tipo', 'acao')
        ->whereIn('movimento', ['compra', 'venda'])
        ->whereYear('data', $data_inicio)
        ->get();
        $dadosAtivos = [];

        $movimentosFiis = MovimentoAtivos::where('tipo', 'fundo imobiliario')
        ->whereIn('movimento', ['compra', 'venda'])
        ->whereYear('data', $data_inicio)
        ->get();
        $dadosfiis = [];

        $dadosAtivos = $this->calcularMovimentos($movimentosAcoes->groupBy('nome'));
        $dadosfiis = $this->calcularMovimentos($movimentosFiis->groupBy('nome'));

        $pdf = PDF::loadView('PDF.irpdf', compact('dadosAtivos', 'dadosfiis'));

        return $pdf->stream('download.pdf');
    }

    /* excel*/

    public function exportAtivos($data_ini, $tip)
    {
        $data_inicio = $data_ini;
        $tipo = $tip;
        $movimentosAtivos = MovimentoAtivos::where('tipo', $tipo)
        ->whereIn('movimento', ['compra', 'venda'])
        ->whereYear('data', $data_inicio)
        ->get();

        $dadosAtivos = [];

        $dadosAtivos = $this->calcularMovimentosExcel($movimentosAtivos->groupBy('nome'));

        if ($tipo == "fundo imobiliario") {
            return Excel::download(new AtivosExport($dadosAtivos), 'Fiis.xlsx');
        } else {
            return Excel::download(new AtivosExport($dadosAtivos), 'Ações.xlsx');
        }
        
    }
  
}
