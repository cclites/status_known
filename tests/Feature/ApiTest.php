<?php

namespace Tests\Feature;

use App\User;
use GuzzleHttp\Client;
use Tests\TestCase;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Role as R;
use App\Permission as P;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function testCanHitGateway()
    {
        $path = env('API_BASE_PATH') . "gateway?api_token=" . env('API_DEV_TOKEN');
        $client = new Client();

        $response = $client->request('GET', $path);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCanHitLoader()
    {
        $path = env('API_BASE_PATH') . "loader?api_token=" . env('API_DEV_TOKEN');
        $client = new Client();
        $response = $client->request('GET', $path);
        $this->assertEquals(200, $response->getStatusCode());
    }

}
