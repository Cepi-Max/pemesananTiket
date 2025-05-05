<?php

namespace App\Mail;

use App\Models\PesanTiket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade as PDF;

class TiketEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $pesanTiket;
    public $pdf;

    public function __construct(PesanTiket $pesanTiket, $pdf)
    {
        $this->pesanTiket = $pesanTiket;
        $this->pdf = $pdf;
    }

    public function build()
    {
        return $this->subject('Tiket Anda')
                    ->view('emails.tiket')
                    ->attachData($this->pdf->output(), 'invoice.pdf');
    }
}
