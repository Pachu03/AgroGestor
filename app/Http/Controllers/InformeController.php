<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;
use App\Models\Collection;
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
            'harvest_id' => 'required|exists:collections,id'
        ]);

        // Obtener la cosecha seleccionada
        $collection = Collection::findOrFail($request->harvest_id);

        if ($request->input('action') == 'download') {
            // Generar el contenido del PDF
            $pdfContent = $this->generatePDFContent($collection);

            // Devolver el PDF como respuesta HTTP para descargarlo
            $fileName = "informe_cosecha_{$collection->product->name}_{$collection->date_collection}.pdf";
            return response($pdfContent)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', "attachment; filename=\"$fileName\"");
        } else {
            // Renderizar la vista HTML con los datos
            return view('report.report', compact('collection'));
        }
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

        // Agregar el logo en la esquina superior izquierda
        $pdf->Image(public_path('img/logo.jpeg'), 10, 10, 30, 0, '', '', 'T', false, 300, '', false, false, 0, false, false, false);

        // Subtítulo con el producto y fecha
        $pdf->SetFont('helvetica', '', 14);
        $pdf->Cell(0, 30, "{$collection->product->name} - {$collection->date_collection}", 0, 1, 'C');

        // Establecer la fuente para el contenido
        $pdf->SetFont('helvetica', '', 12);

        // Crear la tabla con los datos
        $tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <th>Fecha de Recolección</th>
        <td>{$collection->date_collection}</td>
    </tr>
    <tr>
        <th>Cantidad Recogida</th>
        <td>{$collection->quantity_collection} kg</td>
    </tr>
    <tr>
        <th>Producto</th>
        <td>{$collection->product->name}</td>
    </tr>
    <tr>
        <th>Grupo</th>
        <td>{$collection->group->name}</td>
    </tr>
    <tr>
        <th>Integrantes</th>
        <td>
EOD;

        foreach ($collection->group->users as $user) {
            $tbl .= $user->name . "<br>";
        }

        $tbl .= <<<EOD
        </td>
    </tr>
    <tr>
        <th>Jefe</th>
        <td>{$collection->user->name}</td>
    </tr>
</table>
EOD;

        // Añadir la tabla al PDF
        $pdf->writeHTML($tbl, true, false, false, false, '');

        // Salida del PDF como una cadena
        return $pdf->Output('', 'S');
    }
}
