<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;
use App\Models\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class InformeController extends Controller
{
    public function selectHarvest()
    {
        // Obtener las cosechas del usuario actual
        $cosechas = Collection::where('user_id', Auth::id())->get();

        return view('report.index', compact('cosechas'));
    }

    public function generateReport(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'id' => 'required|exists:collections,id'
        ]);

        // Obtener la cosecha seleccionada
        $collection = Collection::findOrFail($request->id);

        // Generar el contenido del PDF
        $pdfContent = $this->generatePDFContent($collection);

        // Devolver el PDF como respuesta HTTP para descargarlo
        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="informe_cosecha.pdf"');
    }
    private function generatePDFContent($collection)
    {
        // Crear una instancia de TCPDF
        $pdf = new TCPDF();

        // Establecer el título y el margen
        $pdf->SetTitle('Informe de Cosecha');
        $pdf->SetMargins(10, 10, 10);

        // Agregar una página
        $pdf->AddPage();

        // Agregar contenido a la página (aquí debes diseñar la apariencia del informe)
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, 'Informe de Cosecha', 0, true, 'C', 0, '', 0, false, 'T', 'M');

        // Aquí puedes agregar más contenido según sea necesario

        // Salida del PDF como una cadena
        return $pdf->Output('informe_cosecha.pdf', 'S');
    }
}
