<?php

namespace Tests\Functions;

use App\Business;
use App\Permission as P;
use App\Role as R;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Cast\Object_;
use Tests\TestCase;
use App\User;
use App\Invoice;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;


class InvoiceControllersTest extends TestCase
{
    use RefreshDatabase;

    public $user;

    public function setUp() : void
    {
        echo "\nInvoice Controller tests\n";

        parent::setUp();

        $this->user = factory(User::class)->create();
        Auth::login($this->user, true);
        $this->user->assignRole(R::BUSINESS);
    }

    public function testInvoiceCanBeCreated()
    {
        $faker = Faker::create();

        $this->user->givePermissionTo(P::CAN_CREATE);
        $business = factory(Business::class)->create()->toArray();
        $tracking = $faker->password(16);

        /** Seed the DB */
        $records = factory(\App\Record::class, 4)
            ->create(['business_id'=> $business['id']])
            ->each(function($record) use ($business){

                factory(\App\Invoice::class)
                    ->create(
                        [
                            'business_id'=> $business['id'],
                        ]
                    );
            });

        $invoice = factory(Invoice::class)
                    ->make(['business_id' => $business['id'], 'tracking'=>$tracking])
                    ->toArray();

        $response = $this
                    ->actingAs($this->user)
                    ->post('/invoices/', $invoice);

        $invoices = Invoice::all();
        $foundMatch = false;

        //TRACKING TEST
        $invoices->each(function($invoice) use($tracking, &$foundMatch){

            if($invoice['tracking'] == $tracking){
                $foundMatch = true;
            }
        });

        $this->assertTrue($foundMatch);
    }


    public function testInvoiceCannotBeCreated()
    {
        $invoice = factory(Invoice::class)->create()->toArray();

        $response = $this
            ->actingAs($this->user)
            ->post('/invoices/', $invoice);

        $response->assertStatus(403);
    }


    public function testInvoiceCanBeUpdated()
    {
        $business = factory(Business::class)->create()->toArray();

        $invoiceAmount = 1999.99;
        $this->user->givePermissionTo(P::CAN_UPDATE);

        $invoice = factory(Invoice::class)->create([
            'business_id' => $business['id']
        ]);


        $invoice['amount'] = $invoiceAmount;

        $url = '/invoices/' . $invoice['id'] . '/';

        $this
            ->actingAs($this->user)
            ->patch($url, $invoice->toArray());

        $invoices = Invoice::all();
        $foundMatch = false;

        $invoices->each(function($i) use($invoice, &$foundMatch, $invoiceAmount){

            if($i['tracking'] == $invoice['tracking'] && $i['amount'] == $invoiceAmount){
                $foundMatch = true;
            }
        });

        $this->assertTrue($foundMatch);
    }

    public function testInvoiceCannotBeUpdated()
    {
        $invoice = factory(Invoice::class)->create();
        $url = '/invoices/' . $invoice->id . '/';

        $response = $this
            ->actingAs($this->user)
            ->patch($url, $invoice->toArray());

        $response->assertStatus(403);
    }


    public function testInvoiceCanBeDeleted()
    {
        $this->user->givePermissionTo(P::CAN_DELETE);
        $business = factory(Business::class)->create()->toArray();
        $invoice = factory(Invoice::class)->create([
            'business_id'=>$business['id']
        ]);

        $url = '/invoices/' . $invoice->id . '/';

        $this
            ->actingAs($this->user)
            ->delete($url, $invoice->toArray());


        $invoices = Invoice::all();
        $foundMatch = false;

        $invoices->each(function($i) use($invoice, &$foundMatch){

            if($i['tracking'] == $invoice['tracking']){
                $foundMatch = true;
            }
        });

        $this->assertFalse($foundMatch);
    }


    public function testInvoiceCannotBeDeleted()
    {
        $business = factory(Business::class)->create()->toArray();
        $invoice = factory(Invoice::class)->create([
            'business_id'=>$business['id']
        ]);

        $url = '/invoices/' . $invoice->id . '/';

        $response = $this
            ->actingAs($this->user)
            ->delete($url);

        $response->assertStatus(403);
    }

    public function testCanShowInvoice(){

        $this->user->givePermissionTo(P::CAN_READ);

        $business = factory(Business::class)->create()->toArray();
        $invoice = factory(Invoice::class)->create([
            'business_id'=>$business['id']
        ]);

        $url = '/invoices/' . $invoice['id'] . '/';

        $response = $this
                        ->actingAs($this->user)
                        ->get($url);

        $invoices = Invoice::all();
        $foundMatch = false;

        $invoices->each(function($i) use($invoice, &$foundMatch){

            if($i['tracking'] == $invoice['tracking']){
                $foundMatch = true;
            }
        });

        $this->assertTrue($foundMatch);
    }

    public function testCannotShowInvoice(){

        $business = factory(Business::class)->create()->toArray();
        $invoice = factory(Invoice::class)->create([
            'business_id'=>$business['id']
        ]);
        $url = '/invoices/' . $invoice['id'] . '/';

        $response = $this
            ->actingAs($this->user)
            ->get($url, $invoice->toArray());

        $response->assertStatus(403);
    }

    public function tearDown(): void
    {
        $this->user->syncPermissions();
    }


}
