<?php

namespace Tests\Unit;

/* use PHPUnit\Framework\TestCase; */

use App\Models\Serie;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SerieTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_series_list_request_works()
    {
        $response = $this->json('GET', '/api/v1/series');
        $response->assertStatus(200);
    }

    public function test_series_list_is_collection()
    {
        $response = $this->json('GET', '/api/v1/series');
        $responseData = $response->getOriginalContent();
        $this->assertInstanceOf(Collection::class, $responseData);
    }

    public function test_series_loading_works()
    {
        $response = $this->json('GET', '/api/v1/series');
        $responseData = $response->getOriginalContent();
        $this->assertEquals(0, $responseData->count());

        Serie::create([
            'nome' => 'serie de teste'
        ]);
    
        $response = $this->json('GET', '/api/v1/series');
        $responseData = $response->getOriginalContent();
        $this->assertEquals(1, $responseData->count());
    }

    public function test_series_create_new_serie()
    {
      $data = [
        'nome' => 'nome-serie-criada', 
        'status' => 'assistido'
      ];
      $response = $this->json('POST', '/api/v1/serie', $data);
      $responseData = $response->getOriginalContent();
      $this->assertEquals($data['nome'], $responseData['nome']);
      $this->assertEquals($data['status'], $responseData['status']);
      $response->assertStatus(201);
    }

    public function test_action_show_response_status_fail()
    {
      $response = $this->json('GET', '/api/v1/serie/1');
      $response->assertStatus(404);
    }

    public function test_action_show_response_status_success()
    {
      $data = [
        'nome' => 'nome-serie-criada', 
        'status' => 'assistido'
      ];
      $response = $this->json('POST', '/api/v1/serie', $data);
      $responseData = $response->getOriginalContent();
      $this->assertEquals(1, $responseData['id']);
      $response = $this->json('GET', '/api/v1/serie/1');
      $response->assertStatus(200);
    }

    public function test_series_update_id_not_integer()
    {
      $response = $this->json('PATCH', '/api/v1/serie/a');
      $response->assertStatus(404);
    }

    public function test_series_update_invalid_input()
    {
      $data = [
        'nome' => 'nome-serie-criada', 
        'status' => 'assistido'
      ];
      $this->json('POST', '/api/v1/serie', $data);
      $upData = [
        'nome' => 'nom', 
        'status' => 'Testeassistido'
      ];

      $response = $this->json('PATCH', '/api/v1/serie/1', $upData);
      $response->assertStatus(422);
    }
    public function test_series_update_success() 
    {
      $data = [
        'nome' => 'nome-serie-criada', 
        'status' => 'assistido'
      ];
      $this->json('POST', '/api/v1/serie', $data);
      $dataUpdate = [
        'nome' => 'teste-update',
        'status' => 'não-assistido'
      ];
      $resp = $this->json('PATCH', '/api/v1/serie/1', $dataUpdate);
      $resp->assertStatus(204);
    }

    public function test_series_status_change() 
    {
      $data = [
        'nome' => 'nome-serie-criada', 
        'status' => 'assistido'
      ];
      $this->json('POST', '/api/v1/serie', $data);
      $this->json('PUT', '/api/v1/serie/status/1'); 
      $response = $this->json('GET', '/api/v1/serie/1');
      $this->assertEquals('não-assistido', $response['status']);
      
      $this->json('PUT', '/api/v1/serie/status/1'); 
      $response = $this->json('GET', '/api/v1/serie/1');
      $this->assertEquals('assistido', $response['status']);
    }

    public function test_series_delete_success()
    {
      $data = [
        'nome' => 'nome-serie-criada', 
        'status' => 'assistido'
      ];
      $this->json('POST', '/api/v1/serie', $data);
      $resp = $this->json('DELETE', '/api/v1/serie/1');
      $response = $this->json('GET', '/api/v1/serie/1');
      $response->assertStatus(404);

      $resp->assertStatus(200);

    }
}
