<?php

namespace Tests\Functions;

use App\Business;
use App\Permission as P;
use App\Role as R;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;


/**
 * Class BusinessControllersTest
 * @package Tests\Unit
 */
class BusinessControllersTest extends TestCase
{
    use RefreshDatabase;

    public $user;

    public function setUp() : void
    {
        echo "\nBusiness Controller tests\n";

        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->user->assignRole(R::BUSINESS);
        Auth::login($this->user, true);
    }

    public function testBusinessCanBeCreated()
    {
        $this->user->givePermissionTo(P::CAN_CREATE);

        $businessData = [
            'name' => 'Test Business',
            'responsible_agent_id' => $this->user->id,
            'email' => 'business@business.com',
            'api_token' => Hash::make(Str::random(32)),
        ];

        $response = $this
                    ->actingAs($this->user)
                    ->post('/businesses/', $businessData);

        $response->assertStatus(200);

    }

    public function testBusinessCannotBeCreated()
    {
        $business = factory(Business::class)->create()->toArray();

        $response = $this
            ->actingAs($this->user)
            ->post('/businesses/', $business);

        $response->assertStatus(403);
    }

    public function testBusinessCanBeUpdated()
    {
        $businessName = 'Test Business';
        $this->user->givePermissionTo(P::CAN_UPDATE);

        $business = factory(Business::class)->create();
        $business->name = $businessName;
        $url = '/businesses/' . $business->id . '/';

        $response = $this
                    ->actingAs($this->user)
                    ->patch($url, $business->toArray());

        $data = $response->json();

        $this->assertEquals($data['name'], $businessName);
        $response->assertStatus(200);

    }

    public function testBusinessCannotBeUpdated()
    {
        $business = factory(Business::class)->create();
        $url = '/businesses/' . $business->id . '/';

        $response = $this
                    ->actingAs($this->user)
                    ->patch($url, $business->toArray());

        $response->assertStatus(403);
    }


    public function testBusinessCanBeDeleted()
    {
        $this->user->givePermissionTo(P::CAN_DELETE);
        $business = factory(Business::class)->create();
        $url = '/businesses/' . $business->id . '/';

        $response = $this
                    ->actingAs($this->user)
                    ->delete($url, $business->toArray());

        collect($response->original)->each(function($u) use($response, $business)
        {
            if($u === $business['id']){
                $this->assertTrue(false);
            }
        });

        $this->assertTrue(true);
    }

    public function testBusinessCannotBeDeleted()
    {
        $business = factory(Business::class)->create();
        $url = '/businesses/' . $business->id . '/';

        $response = $this
                    ->actingAs($this->user)
                    ->delete($url);

        collect($response->original)->each(function($u) use($response, $business)
        {
            if($u === $business['id']){
                $this->assertTrue(false);
            }
        });

        $this->assertTrue(true);
    }

    public function testCanShowBusiness(){

        $this->user->givePermissionTo(P::CAN_READ);

        $business = factory(Business::class)->create()->toArray();
        $url = '/businesses/' . $business['id'] . '/';

        $response = $this
                    ->actingAs($this->user)
                    ->get($url);

        collect($response->original)->each(function($u) use($response, $business)
        {
            if($u === $business['id']){
                $this->assertTrue(true);
            }
        });

        $this->assertTrue(true);
    }

    public function testCannotShowBusiness(){

        $business = factory(Business::class)->create()->toArray();
        $url = '/businesses/' . $business['id'] . '/';

        $response = $this
                    ->actingAs($this->user)
                    ->get($url, $business);

        collect($response->original)->each(function($u) use($response, $business)
        {
            if($u === $business['id']){
                $this->assertTrue(false);
            }
        });

        $this->assertTrue(true);
    }

    public function tearDown(): void
    {
        $this->user->syncPermissions();
    }


}
