<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use FPDI;
use Illuminate\Support\Facades\Storage;

# we want to define this only once
define('FPDF_FONTPATH',base_path().'/resources/assets/pdf/font');
class Bill extends Model
{

    /*
     *
     */
    public function course()
    {
        return $this->belongsTo('App\Course');
    }
    /*
     *
     */
    public function save(array $options = array())
    {

        $filename = $this->createBill($this->course()->getResults());
        $this->amount = $this->course()->getResults()->participantNum;
        $this->filename=$filename;
        parent::save($options);

    }


    private function createBill(Course $course)
    {
        $user = $course->user()->getResults();
        // $name = 'Fritz';
        // $lastname ='Hauser';
        // $courseName ='Parties für Introvertierte';
        $id=1;
        $date=date('m.d.Y');
        // $maxPart=34;

        $pdf = new FPDI();
        $disk = Storage::disk('local');
        $templatePath= base_path().'/resources/assets/pdf/bill_template.pdf';
        $filename=$this->generateFileName();


        # set fonts and whatnot
        $pdf->AddFont('Calibri','','calibri.php');
        $pdf->AddFont('Calibri','B','calibrib.php');
        $pdf->SetFont('Calibri','',11);

        # load template PDF

        $pdf->AddPage();
        $pdf->setSourceFile($templatePath);
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx);

        #put text into PDF
        $pdf->SetXY(23, 55);
        $pdf->Write(0, $this->sanitizeString($user->firstName));
        $pdf->SetXY(23, 60);
        $pdf->Write(0, $this->sanitizeString($user->lastName));
        $pdf->SetXY(23, 65);
        $pdf->Write(0, $this->sanitizeString($user->address));
        $pdf->SetXY(23, 70);
        $pdf->Write(0, $this->sanitizeString($user->zip));
        $pdf->SetXY(33, 70);
        $pdf->Write(0, $this->sanitizeString($user->city));
        $pdf->SetXY(23, 75);
        $pdf->Write(0, $this->sanitizeString($user->country));
        $pdf->SetXY(55,101);
        $pdf->Write(0, $this->sanitizeString(mt_rand(1232,3545345)));
        $pdf->SetXY(55,106  );
        $pdf->Write(0, $this->sanitizeString(utf8_decode($date)));
        $pdf->SetXY(26,124);
        $pdf->Write(0, $this->sanitizeString($course->courseName));
        $pdf->SetXY(32,128.2);
        $pdf->Write(0, $course->id);
        $pdf->SetXY(70,124);
        $pdf->Write(0, utf8_decode($date));
        $pdf->SetXY(110,124);
        $pdf->Write(0, $course->participantNum);
        $pdf->SetXY(165,124);
        $pdf->Write(0, $course->participantNum);
        $pdf->SetXY(165,138);
        $pdf->SetFont('Calibri','B',11);
        $pdf->Write(0, $course->participantNum);
        $output =  $pdf->Output('','s');
        $disk->put($filename,$output);
        return $filename;

    }
    private function sanitizeString($string)
    {
        return utf8_decode($string);
    }

    private function generateFileName()
    {
        $filename = uniqid('bill_');
        $filename .= '.pdf';
        return $filename;
    }
    public function path(){
        return storage_path()."/app/".$this->filname;
    }

}