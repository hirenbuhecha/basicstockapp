<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendStockDataEmail($email, $companyName, $startDate, $endDate, $historicalData)
    {
        Mail::to($email)->send(new \App\Mail\StockDataMail($companyName, $startDate, $endDate, $historicalData));
    }
}
