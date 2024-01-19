<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StockDataMail extends Mailable
{
    use Queueable, SerializesModels;

    public $companyName;
    public $startDate;
    public $endDate;
    public $historicalData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($companyName, $startDate, $endDate, $historicalData)
    {
        $this->companyName = $companyName;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->historicalData = $historicalData;
    }

    public function build()
    {
        return $this->subject($this->companyName)
            ->view('emails.stock-data-mail');
    }
}
