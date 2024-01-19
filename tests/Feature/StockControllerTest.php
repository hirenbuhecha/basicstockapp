<?php

namespace Tests\Feature;

use Tests\TestCase;
use GuzzleHttp\Client;
use App\Services\StockApiService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StockControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the stock form page is accessible.
     *
     * @return void
     */
    public function testStockFormPage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test submitting the stock form with valid data.
     *
     * @return void
     */
    public function testSubmitFormWithValidData()
    {
        $this->mockGuzzleClient();

        $response = $this->post('/submit-form', [
            '_token' => csrf_token(),
            'company_symbol' => 'AMRN',
            'start_date' => '2024-01-01',
            'end_date' => '2024-01-18',
            'email' => 'stapp@yopmail.com',
        ]);
        $response->assertStatus(200)
            ->assertViewHas('data');
    }

    /**
     * Test submitting the stock form with invalid data.
     *
     * @return void
     */
    public function testSubmitFormWithInvalidData()
    {
        $response = $this->post('/submit-form', [
            // Invalid symbol (should be alpha-numeric)
            'company_symbol' => 'InvalidSymbol123$',
            'start_date' => '2023-01-01',
            'end_date' => '2023-01-10',
            'email' => 'test@example.com',
        ]);

        $response->assertSessionHasErrors(['company_symbol']);
    }

    /**
     * Mock the Guzzle client to avoid actual HTTP requests during testing.
     *
     * @return void
     */
    private function mockGuzzleClient()
    {
        $client = new Client();
        $stockApiService = new StockApiService($client);

        $mock = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mock->method('get')
            ->willReturnCallback(function ($url) use ($stockApiService) {
                $symbol = 'AMRN';
                if (!$stockApiService->isSymbolValid($symbol)) {
                    return new \GuzzleHttp\Psr7\Response(404, [], 'Invalid company symbol.');
                }
                return new \GuzzleHttp\Psr7\Response(200, [], '{"prices": [{"date": "2023-01-05", "close": 150.50}]}');
            });

        $this->app->instance(Client::class, $mock);

        $this->app->instance(StockApiService::class, $stockApiService);
    }

}
