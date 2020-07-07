<?php

namespace Tests\Functions;

use App\Record;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Permission as P;
use App\Role as R;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Business;

class RecordControllersTest extends TestCase
{
    use RefreshDatabase;

    public $business;

    public $record;

    public $user;

    public function setUp() : void
    {
        echo "\nRecord Controller tests\n";

        parent::setUp();

        $this->business = factory(Business::class)->create()->toArray();

        $this->user = factory(User::class)->create(['business_id'=> $this->business['id']]);
        $this->user->assignRole(R::BUSINESS);
        Auth::login($this->user, true);

        $this->record = factory(Record::class)->create([
            'business_id' => $this->business['id'],
            'created_by_id'=> $this->user['id']
        ]);
    }

    public function testCanSetup(){

        $this->assertTrue(filled($this->record));
    }

    public function testUserCanCreateRecord(){

        $this->user->givePermissionTo(P::CAN_CREATE);

        $record = factory(Record::class)->create([
            'business_id' => $this->business['id'],
            'created_by_id'=> $this->user['id']
        ])->toArray();

        $response = $this
            ->actingAs($this->user)
            ->post('/businesses/', $record);

        $this->assertEquals(200, $response->getStatusCode());

    }
}
