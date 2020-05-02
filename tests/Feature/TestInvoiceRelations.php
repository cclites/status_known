<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestInvoiceRelations extends TestCase
{
    public $business;
    public $provider;
    public $user;
    public $record;
    public $invoice;

    protected function setUp() : void
    {
        parent::setUp();

        $this->business = factory(\App\Business::class)->create();
        $this->user = factory(\App\User::class)->create(['business_id'=> $this->business->id]);
        $this->record = factory(\App\Record::class)->create(['business_id'=> $this->business->id, 'provider_id'=> $this->provider_id, 'created_by_id'=> $this->user_id]);
        $this->report = factory(\App\Report::class)->create(['business_id'=> $this->business->id, 'provider_id'=> $this->provider_id, 'created_by_id' => $this->user_id]);
        $this->invoice = factory(\App\Invoice::class)->create(['business_id'=> $this->business->id, 'tracking' => $this->record['tracking']]);
    }

    public function testInvoiceHasBusiness(){
        $this->record->load('business');
        $this->assertNotNull($this->invoice['business']);
    }

    public function testReportHasRecord(){
        $this->record->load('record');
        $this->assertNotNull($this->invoice['record']);
    }

    public function testReportHasReport(){
        $this->record->load('record');
        $this->assertNotNull($this->invoice['record']);
    }
}
