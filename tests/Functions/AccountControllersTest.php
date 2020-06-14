<?php

namespace Tests\Functions;

use App\Permission as P;
use App\Role as R;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Account;
use App\Address;
use App\Business;
use App\User;
use Faker\Generator as Faker;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AccountControllersTest extends TestCase
{
    use RefreshDatabase;

    public $user;

    public function setUp() : void
    {
        echo "\nAccount Controller tests\n";

        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->user->assignRole(R::BUSINESS);

        Auth::login($this->user, true);
    }

    public function testAccountCanBeCreated()
    {
        $this->user->givePermissionTo(P::CAN_CREATE);
        $business = factory(Business::class)->create();

        $account = factory(Account::class)
            ->create([
                'business_id' => $business->id
            ]);

        $this
            ->actingAs($this->user)
            ->post('/accounts/', $account->toArray());

        $accounts = Account::all();
        $foundMatch = false;

        //TRACKING TEST
        $accounts->each(function($a) use($account, &$foundMatch){

            if($account['id'] == $a['id']){
                $foundMatch = true;
            }
        });

        $this->assertTrue($foundMatch);
    }


    public function testAccountCannotBeCreated()
    {
        $account = factory(Account::class)->create()->toArray();

        $response = $this
            ->actingAs($this->user)
            ->post('/accounts/', $account);

        $response->assertStatus(403);
    }


    public function testAccountCanBeUpdated()
    {
        $business = factory(Business::class)->create();

        $account_name = "TEST ACCOUNT NAME";
        $this->user->givePermissionTo(P::CAN_UPDATE);

        $account = factory(Account::class)->create([
            'business_id' => $business->id
        ]);


        $account['account_name'] = $account_name;

        $url = '/accounts/' . $account['id'] . '/';

        $this
            ->actingAs($this->user)
            ->patch($url, $account->toArray());

        $accounts = Account::all();
        $foundMatch = false;

        //TRACKING TEST
        $accounts->each(function($a) use($account, $account_name, &$foundMatch){

            if($account['account_name'] == $account_name){
                $foundMatch = true;
            }
        });

        $this->assertTrue($foundMatch);
    }


    public function testAccountCannotBeUpdated()
    {
        $account = factory(Account::class)->create();
        $url = '/accounts/' . $account->id . '/';

        $response = $this
            ->actingAs($this->user)
            ->patch($url, $account->toArray());

        $response->assertStatus(403);
    }

    public function testAccountCanBeDeleted()
    {

        $this->user->givePermissionTo(P::CAN_DELETE, P::CAN_CREATE);

        $business = factory(Business::class)->create();

        $account = factory(Account::class)
            ->create([
                'business_id' => $business->id
            ]);

        $response = $this
            ->actingAs($this->user)
            ->post('/accounts/', $account->toArray());

        $response = $this
                    ->actingAs($this->user)
                    ->delete('/accounts/' . $account->id);

        if($response->status() !== 200){

            echo "\n\n***************Response Status: " . $response->status() . "\n";

            $this->assertTrue(false);
            return;
        }

        $accounts = Account::all();
        $foundMatch = false;

        $accounts->each(function($i) use($account, &$foundMatch){

            if($i['id'] == $account->id){
                echo "FOUND A MATCH\n";
                $foundMatch = true;
                return;
            }
        });

        $this->assertFalse($foundMatch);
    }

    public function testAccountCannotBeDeleted()
    {
        $this->user->syncPermissions();

        $business = factory(Business::class)->create();
        $account = factory(Account::class)->create([
            'business_id'=>$business->id
        ]);

        $url = '/accounts/' . $account->id . '/';

        $response = $this
            ->actingAs($this->user)
            ->delete($url);

        $response->assertStatus(403);
    }


    public function testCanShowAccount(){

        $this->user->givePermissionTo(P::CAN_READ);

        $business = factory(Business::class)->create()->toArray();
        $account = factory(Account::class)->create([
            'business_id'=>$business['id']
        ]);

        $url = '/accounts/' . $account['id'] . '/';

        $response = $this
                        ->actingAs($this->user)
                        ->get($url);

        $accounts = Account::all();
        $foundMatch = false;

        $accounts->each(function($i) use($account, &$foundMatch){

            if($i['id'] == $account['id']){
                $foundMatch = true;
            }
        });

        $this->assertTrue($foundMatch);
    }

    public function testCannotShowAccount(){

        $business = factory(Business::class)->create();
        $account = factory(Account::class)->create([
            'business_id' => $business->id
        ]);
        $url = '/accounts/' . $account['id'] . '/';

        $response = $this
            ->actingAs($this->user)
            ->get($url, $account->toArray());

        $response->assertStatus(403);
    }

    public function tearDown(): void
    {
        $this->user->syncPermissions();
    }
}
