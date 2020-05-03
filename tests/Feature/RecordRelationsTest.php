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
        echo "\nTesting Record Relations\n";

        $this->business = factory(\App\Business::class)->create();

        $this->provider = factory(\App\Provider::class)->create();

        $this->user = factory(\App\User::class)->create(['business_id'=> $this->business['id']]);

        $this->record = factory(\App\Record::class)->create(['business_id'=> $this->business['id'], 'created_by_id'=> $this->user['id'], 'provider_id'=>$this->provider['id']]);

        $this->report = factory(\App\Report::class)->create(['business_id'=> $this->business['id'],  'requested_by_id' => $this->user['id'], 'tracking' => $this->record['tracking'], 'record_id' => $this->record['id']]);

        $this->invoice = factory(\App\Invoice::class)->create(['business_id'=> $this->business['id'], 'tracking' => $this->record['tracking']]);

        \Log::info("This business");
        \Log::info(json_encode($this->business));
        \Log::info("This user");
        \Log::info(json_encode($this->user));
        \Log::info("This record");
        \Log::info(json_encode($this->record));
        \Log::info("This report");
        \Log::info(json_encode($this->report));
        \Log::info("This invoice");
        \Log::info(json_encode($this->invoice));
        \Log::info("*******************************************************\n\n");
    }

    public function testRecordHasBusiness(){
        $this->record->load('business');
        $this->assertNotNull($this->record['business']);
    }

    public function testRecordHasProvider(){
        $this->record->load('provider');
        $this->assertNotNull($this->record['provider']);
    }

    public function testRecordHasInvoice(){
        $this->record->load('invoice');
        $this->assertNotNull($this->record['invoice']);
    }

    public function testRecordHasCreated_by(){
        $this->record->load('created_by');
        $this->assertNotNull($this->record['created_by']);
    }

}
