<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StockApiService;
use App\Services\EmailService;

class StockController extends Controller
{
    private $stockApiService;
    private $emailService;

    public function __construct(StockApiService $stockApiService, EmailService $emailService)
    {
        $this->stockApiService = $stockApiService;
        $this->emailService = $emailService;
    }

    public function index()
    {
        return view('stock-form');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'company_symbol' => 'required|alpha',
            'start_date' => 'required|date|before_or_equal:end_date|before_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date|before_or_equal:today',
            'email' => 'required|email',
        ]);

        $symbol = $request->input('company_symbol');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (!$this->stockApiService->isSymbolValid($symbol)) {
            return redirect()->route('home')->withErrors(['company_symbol' => 'Invalid company symbol.']);
        }

        $historicalData = $this->stockApiService->getHistoricalData($symbol, $startDate, $endDate);

        $companyName = $this->stockApiService->getCompanyName($symbol);
        $email = $request->input('email');
        $this->emailService->sendStockDataEmail($email, $companyName, $startDate, $endDate, $historicalData);

        return view('stock-form')->with('data', $historicalData)->with('companyName', $companyName);
    }
}
