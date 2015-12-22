<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

# we want to define this only once
define('FPDF_FONTPATH',base_path().'/resources/assets/pdf/font');
class Bill extends Model
{

    //
    public function user()
    {
        $this->belongsTo('App\User');
    }

    public function course()
    {
        $this->belongsTo('App\Course');
    }

    public function createBill(Course $course)
    {
        $name = 'Fritz';
        $lastname ='Hauser';
        $courseName ='Parties für Introvertierte';
        $id=1;
        $date="22.3.2015";
        $maxPart=34;
        $pdf = new FPDI();
        $pdf->AddPage();
        $disk = Storage::disk('local');
        $templatePath= base_path().'/resources/assets/pdf/bill_template.pdf';
        #dd($template = $disk->path('bill_template.pdf'));
        $pdf->setSourceFile($templatePath);
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx);
        $pdf->AddFont('Calibri','','calibri.php');
        $pdf->AddFont('Calibri','B','calibrib.php');
        $pdf->SetFont('Calibri','',11);

        $pdf->SetXY(55,101);
        $pdf->Write(0, $name);
        $pdf->SetXY(55,106);
        $pdf->Write(0, $lastname);
        $pdf->SetXY(26,124);
        $pdf->Write(0, utf8_decode($courseName));
        $pdf->SetXY(32,128.2);
        $pdf->Write(0, $id);
        $pdf->SetXY(70,124);
        $pdf->Write(0, utf8_decode($date));
        $pdf->SetXY(110,124);
        $pdf->Write(0, utf8_decode($maxPart));
        $pdf->SetXY(165,124);
        $pdf->Write(0, utf8_decode($maxPart));
        $pdf->SetXY(165,138);
        $pdf->SetFont('Calibri','B',11);
        $pdf->Write(0, utf8_decode($maxPart));
        $output =  $pdf->Output('','s');
        $disk->put("test.pdf",$output);
        $pdf->Output();

    }

}
