<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
class CetakController extends Controller
{
    public function generate_pdf()
    {
        $data = [
        'foo' => 'bar'
        ];
        $fonts = [
            'arial-mt' => [
                'R'  => 'Arial-MT.ttf',    // regular font
                'B'  => 'Arial-MT-Bold.ttf',       // optional: bold font
                'I'  => 'arial-mt-medium-italic.ttf',     // optional: italic font
                'BI' => 'Arial-MT.ttf' // optional: bold-italic font
            ],
        ];
        $pdf = PDF::loadView('cetak.blank', $data, [], [
            'orientation' => 'P',
            'default_font_size'    => '14',
            'custom_font_dir' => public_path('templates-pdf/fonts/'), // don't forget the trailing slash!
            'custom_font_data' => $fonts,
            'default_font'         => 'arial-mt',
            'margin_top' => 30,
            'margin_left' => 10,
            'margin_right' => 10,
        ]);
        $pagecount = $pdf->getMpdf()->setSourceFile('templates-pdf/template-sertifikat.pdf');
        $tplIdx = $pdf->getMpdf()->importPage(1);
        $pdf->getMpdf()->useTemplate($tplIdx);
        $satuan = view('cetak.document', compact('data'));
        $pdf->getMpdf()->SetWatermarkImage('/img/wm.png');
        $pdf->getMpdf()->showWatermarkImage = true;
        $pdf->getMpdf()->WriteHTML($satuan);
        return $pdf->stream('document.pdf');
    }
}
