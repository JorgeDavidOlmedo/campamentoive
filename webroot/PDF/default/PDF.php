<?php
   // App::import('webroot', 'fpdf/fpdf');
    require_once(ROOT . DS . 'webroot' . DS . "fpdf" . DS . "fpdf.php");


    class PDF extends FPDF
    {

        public $titulo;
        public $subtitulo;


        function Footer()
        {
            $this->SetY(-15);
            $this->Cell(0, 10, ("CDE, CENTRO"));
            $this->Ln(2.5);
            $this->Cell(0, 10, "CONTALAPP, SIGA");
            $this->Ln(2.5);
            $this->Cell(0, 10, "TELEFONO: 0986669700");

            $this->SetFont('Arial', 'I', 8);
            $this->AliasNbPages();
            $this->Cell(0, 10, ('Pagina ') . $this->PageNo() . ' de {nb}', 0, 0, 'R');
            $this->Ln(2.5);
            $this->SetFont('Arial', '', 6);
            $this->Cell(0, 10, 'Data: ' . date('d-m-Y'));
        }

    }
?>