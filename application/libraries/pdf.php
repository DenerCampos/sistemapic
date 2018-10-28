<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * author: Dener Junio
 * descrição: Gerar PDF a partir de html
 * data: 16/08/2016
 * mpdf 6 - http://www.mpdf1.com/mpdf/index.php
 * Exemplo: $html = "<html>";
            $html .= "<head></head>";
            $html .= "<body>Meu arquivo de teste</body>";
            $html .= "</html>";
 
            Opcional: Também é possivel carregar uma view inteira...
            $html = $this->load->view('uma_view_qualquer', null, true);
 
            pdf($html);
 */

class Pdf {

    public function geraPdf($html, $css=null, $filename=null){
        require_once("mpdf_lib/mpdf.php");

        $mpdf = new mPDF();

        //$mpdf->allow_charset_conversion=true;
        //$mpdf->charset_in='iso-8859-1';

        //Exibir a pagina inteira no browser
        $mpdf->SetDisplayMode('fullpage');

        //Cabeçalho: Seta a data/hora completa de quando o PDF foi gerado + um texto no lado direito
        //$mpdf->SetHeader('{DATE j/m/Y H:i}|{PAGENO}/{nb}|Texto no cabeçalho');

        //Rodapé: Seta a data/hora completa de quando o PDF foi gerado + um texto no lado direito
        $mpdf->SetFooter('{DATE j/m/Y H:i}|{PAGENO}/{nb}|Impressão de chamado');
        
        //carrega css
        if ($css != null){
            $mpdf->WriteHTML($css, 1);
        }
        
        $mpdf->WriteHTML($html);

        // define um nome para o arquivo PDF
        if($filename == null){
            $filename = date("Y-m-d_his").'_impressao.pdf';
        }

        $mpdf->Output($filename, 'I');
    }
    
    public function geraRelatorioPDF($paginas, $css=null, $filename=null){
        require_once("mpdf_lib/mpdf.php");

        $mpdf = new mPDF();

        //$mpdf->allow_charset_conversion=true;
        //$mpdf->charset_in='iso-8859-1';

        //Exibir a pagina inteira no browser
        $mpdf->SetDisplayMode('fullpage');

        //Cabeçalho: Seta a data/hora completa de quando o PDF foi gerado + um texto no lado direito
        //$mpdf->SetHeader('{DATE j/m/Y H:i}|{PAGENO}/{nb}|Texto no cabeçalho');

        //Rodapé: Seta a data/hora completa de quando o PDF foi gerado + um texto no lado direito
        $mpdf->SetFooter('{DATE j/m/Y H:i}|{PAGENO}/{nb}|Relatório plantão PIC');
        
        //carrega css
        if ($css != null){
            $mpdf->WriteHTML($css, 1);
        }
        
        //Escrevendo paginas
        for ($i = 0; $i < count($paginas); $i++){
            $mpdf->WriteHTML($paginas[$i]);
            if ($i < count($paginas)-1){
                $mpdf->AddPage();
            }
        }

        // define um nome para o arquivo PDF
        if($filename == null){
            $filename = date("Y-m-d_his").'_impressao.pdf';
        } else {
            $filename = './document/relatorio/'.$filename.'.pdf';
        }
        
        $mpdf->Output($filename, "F");
        //$mpdf->Output(date("Y-m-d_his").'_impressao.pdf', 'I');
    }
    
    //gerando avaliacao
    public function geraAvaliacaoPDF($paginas, $css=null, $filename=null, $referencia=null){
        require_once("mpdf_lib/mpdf.php");

        $mpdf = new mPDF();

        //$mpdf->allow_charset_conversion=true;
        //$mpdf->charset_in='iso-8859-1';

        //Exibir a pagina inteira no browser
        $mpdf->SetDisplayMode('fullpage');

        //Cabeçalho: Seta a data/hora completa de quando o PDF foi gerado + um texto no lado direito
        //$mpdf->SetHeader('{DATE j/m/Y H:i}|{PAGENO}/{nb}|Texto no cabeçalho');

        //Rodapé: Seta a data/hora completa de quando o PDF foi gerado + um texto no lado direito
        $mpdf->SetFooter('{DATE j/m/Y H:i}|{PAGENO}/{nb}|Avaliação funcional PIC');
        
        //carrega css
        if ($css != null){
            $mpdf->WriteHTML($css, 1);
        }
        
        //$mpdf->showImageErrors = true;
        //Adiciaona a avaliação
        $mpdf->WriteHTML($paginas, 0);
        
        //verifica se existe a pagina dos valores de referencia
        if (isset($referencia)){
            $mpdf->AddPage();
             $mpdf->WriteHTML($referencia, 0);
        }
        
//        //Escrevendo paginas
//        for ($i = 0; $i < count($paginas); $i++){
//            $mpdf->WriteHTML($paginas[$i]);
//            if ($i < count($paginas)-1){
//                $mpdf->AddPage();
//            }
//        }

        // define um nome para o arquivo PDF
        if($filename == null){
            $filename = date("Y-m-d_his").'_impressao.pdf';
        } else {
            $filename = './document/avaliacao/'.$filename.'.pdf';
        }
        //Gera PDF
        $mpdf->Output($filename, "F");
        //$mpdf->Output(date("Y-m-d_his").'_impressao.pdf', 'I');
    }
    
    //gerando checklist
    public function geraChecklistPDF($paginas, $css=null, $filename=null){
        require_once("mpdf_lib/mpdf.php");
            

        $mpdf = new mPDF();

        //$mpdf->allow_charset_conversion=true;
        //$mpdf->charset_in='iso-8859-1';
        
        //debug
        $mpdf->debug = TRUE;
        $mpdf->showImageErrors = TRUE;

        //Exibir a pagina inteira no browser
        $mpdf->SetDisplayMode('fullpage');

        //Cabeçalho: Seta a data/hora completa de quando o PDF foi gerado + um texto no lado direito
        //$mpdf->SetHeader('{DATE j/m/Y H:i}|{PAGENO}/{nb}|Texto no cabeçalho');

        //Rodapé: Seta a data/hora completa de quando o PDF foi gerado + um texto no lado direito
        $mpdf->SetFooter('{DATE j/m/Y H:i}|{PAGENO}/{nb}|Check-list PIC Pampulha');
        
        //carrega css
        if ($css != null){
            $mpdf->WriteHTML($css, 1);
        }
        
        //$mpdf->showImageErrors = true;
        //Adiciaona
        $mpdf->WriteHTML($paginas, 0);
        
        // define um nome para o arquivo PDF
        if($filename == null){
            $filename = date("Y-m-d_his").'_impressao.pdf';
        } else {
            $filename = './document/checklist/'.$filename.'.pdf';
        }
        //Gera PDF
        $mpdf->Output($filename, "F");
        //$mpdf->Output(date("Y-m-d_his").'_impressao.pdf', 'I');
    }
    
    
    //gerando teste em html
    public function geraTesteHTML($paginas, $css=null, $filename=null){
        
        echo $paginas;

        
    }
}
 
/* End of file pdf.php */
/* Location: /mpdf.php */