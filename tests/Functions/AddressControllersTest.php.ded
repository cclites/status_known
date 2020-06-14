<?php

namespace Tests\Functions;

use App\Permission as P;
use App\Role as R;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Address;
use App\Business;
use App\User;
use Faker\Generator as Faker;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AddressControllersTest extends TestCase
{
    use RefreshDatabase;

    public $user;

    public function setUp() : void
    {
        echo "\nAddress Controller tests\n";

        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->user->assignRole(R::BUSINESS);

        Auth::login($this->user, true);
    }

    public function testAddressCanBeCreated()
    {
        //$faker = Faker::create();

        $this->user->givePermissionTo(P::CAN_CREATE);
        $business = factory(Business::class)->create();


        $address = factory(Address::class)
            ->create([
                'business_id' => $business->id,
            ])
            ->toArray();

        $this
            ->actingAs($this->user)
            ->post('/addresses/', $address);

        $addresses = Address::all();
        $foundMatch = false;

        $addresses->each(function($a) use($address, &$foundMatch){

            if($a['id'] == $address['id']){
                $foundMatch = true;
            }
        });

        $this->assertTrue($foundMatch);
    }


    public function testAddressCannotBeCreated()
    {
        $business = factory(Business::class)->create();
        $address = factory(Address::class)->create([
            'business_id' => $business->id
        ]);

        $response = $this
            ->actingAs($this->user)
            ->post('/addresses/', $address->toArray());

        $response->assertStatus(403);
    }



    public function testAddressCanBeUpdated()
    {
        $business = factory(Business::class)->create()->toArray();

        $address_1 = 'Boogie Woogie Drive';
        $this->user->givePermissionTo(P::CAN_UPDATE);

        $address = factory(Address::class)->create([
            'business_id' => $business['id']
        ]);


        $address['address_1'] = $address_1;

        $url = '/addresses/' . $address['id'] . '/';

        $this
            ->actingAs($this->user)
            ->patch($url, $address->toArray());

        $addresses = Address::all();
        $foundMatch = false;

        $addresses->each(function($i) use($address, $address_1, &$foundMatch){

            if($i['address_1'] == $address_1 && $i['id'] == $address['id']){
                $foundMatch = true;
            }
        });

        $this->assertTrue($foundMatch);
    }

    public function testAddressCannotBeUpdated()
    {
        $business = factory(Business::class)->create()->toArray();
        $address = factory(Address::class)->create([
            'business_id' => $business['id']
        ]);
        $url = '/addresses/' . $address->id . '/';

        $response = $this
            ->actingAs($this->user)
            ->patch($url, $address->toArray());

        $response->assertStatus(403);
    }



    public function testAddressCanBeDeleted()
    {
        $this->user->givePermissionTo(P::CAN_DELETE);
        $business = factory(Business::class)->create()->toArray();

        $address = factory(Address::class)->create([
            'business_id'=>$business['id']
        ]);

        $url = '/addresses/' . $address->id . '/';

        $this
            ->actingAs($this->user)
            ->delete($url, $address->toArray());


        $addresses = Address::all();
        $foundMatch = false;

        $addresses->each(function($i) use($address, &$foundMatch){

            if($i['id'] == $address['id']){
                $foundMatch = true;
            }
        });

        $this->assertFalse($foundMatch);
    }


    public function testAddressCannotBeDeleted()
    {
        $business = factory(Business::class)->create()->toArray();
        $address = factory(Address::class)->create([
            'business_id'=>$business['id']
        ]);

        $url = '/addresses/' . $address->id . '/';

        $response = $this
            ->actingAs($this->user)
            ->delete($url);

        $response->assertStatus(403);
    }


    public function testCanShowAddress(){

        $this->user->givePermissionTo(P::CAN_READ);

        $business = factory(Business::class)->create()->toArray();
        $address = factory(Address::class)->create([
            'business_id'=>$business['id']
        ]);

        $url = '/addresses/' . $address['id'] . '/';

        $this
            ->actingAs($this->user)
            ->get($url);

        $addresses = Address::all();
        $foundMatch = false;

        $addresses->each(function($i) use($address, &$foundMatch){

            if($i['id'] == $address['id']){
                $foundMatch = true;
            }
        });

        $this->assertTrue($foundMatch);
    }

    public function testCannotShowAddress(){

        $business = factory(Business::class)->create()->toArray();
        $address = factory(Address::class)->create([
            'business_id'=>$business['id']
        ]);
        $url = '/addresses/' . $address['id'] . '/';

        $response = $this
            ->actingAs($this->user)
            ->get($url, $address->toArray());

        $response->assertStatus(403);
    }

    public function tearDown(): void
    {
        $this->user->syncPermissions();
    }
}
