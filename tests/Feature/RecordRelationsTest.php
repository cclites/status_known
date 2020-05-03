<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecordRelationsTest extends TestCase
{
    use RefreshDatabase;

    public $business;
    public $provider;
    public $user;
    public $record;
    public $invoice;

    protected function setUp() : void
    {
        parent::setUp();

        $this->business = factory(\App\Business::class)->create();
        $this->provider = factory(\App\Provider::class)->create();
        $this->user = factory(\App\User::class)->create(['business_id'=> $this->business->id]);
        $this->record = factory(\App\Record::class)->create(['business_id'=> $this->business->id, 'provider_id'=> $this->provider->id, 'created_by_id' => $this->user->id]);
        $this->invoice = factory(\App\Invoice::class)->create(['business_id'=> $this->business->id, 'tracking' => $this->record->tracking]);

        echo "Testing Record Relations\n";
    }

    public function testRecordHasBusiness(){
        $this->record->load('business');
        $this->assertNotNull($this->record->business);
    }

    public function testRecordHasProvider(){
        $this->record->load('provider');
        $this->assertNotNull($this->record->provider);
    }

    /*
    public function testRecordHasInvoice(){

        $this->record->load('invoice');

        echo json_encode($this->invoice);

        $this->assertNotNull($this->record->invoice);
    }*/

    public function testRecordHasCreatedBy(){
        $this->record->load('createdBy');
        $this->assertNotNull($this->record->createdBy);
    }

}
