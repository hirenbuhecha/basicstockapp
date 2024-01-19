<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Carbon;

class StockApiService
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getHistoricalData($symbol, $startDate, $endDate)
    {
        $response = $this->client->get('https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data', [
            'headers' => [
                'X-RapidAPI-Key' => 'a495c83c3dmsh52932ddd24542f1p1fef90jsnbfd3e2a4a459',
                'X-RapidAPI-Host' => 'yh-finance.p.rapidapi.com',
            ],
            'query' => [
                'symbol' => $symbol,
                'region' => 'US',
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        $historicalData = $data['prices'] ?? [];

        $filteredData = array_filter($historicalData, function ($row) use ($startDate, $endDate) {
            $currentDate = Carbon::parse($row['date']);
            return $currentDate >= $startDate && $currentDate <= $endDate;
        });

        return $filteredData;
    }

    public function isSymbolValid($symbol)
    {
        $response = $this->client->get('https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json');

        $data = json_decode($response->getBody(), true);

        return collect($data)->pluck('Symbol')->contains($symbol);
    }

    public function getCompanyName($symbol)
    {
        $response = $this->client->get('https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json');

        $data = json_decode($response->getBody(), true);

        $company = collect($data)->firstWhere('Symbol', $symbol);

        return $company ? $company['Company Name'] : '';
    }
}
