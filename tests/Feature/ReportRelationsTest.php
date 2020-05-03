<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReportRelationsTest extends TestCase
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

        echo "Report Relations Test\n";

        $this->business = factory(\App\Business::class)->create();
        $this->provider = factory(\App\Provider::class)->create();
        $this->user = factory(\App\User::class)->create(['business_id'=> $this->business->id]);

        $this->record = factory(\App\Record::class)->create(['business_id'=> $this->business->id, 'provider_id'=> $this->provider->id, 'created_by_id'=> $this->user->id]);
        $this->report = factory(\App\Report::class)->create(['business_id'=> $this->business->id, 'provider_id'=> $this->provider->id, 'requested_by_id' => $this->user->id]);

        //$this->record = factory(\App\Record::class)->create(['business_id'=> $this->business->id, 'provider_id'=> $this->provider->id, 'created_by_id'=>$this->user->id]);
        $this->invoice = factory(\App\Invoice::class)->create(['business_id'=> $this->business->id, 'tracking' => $this->record['tracking']]);
    }

    public function testReportHasBusiness(){
        $this->record->load('business');
        $this->assertNotNull($this->report['business']);
    }

    public function testReportHasInvoice(){
        $this->record->load('invoice');
        $this->assertNotNull($this->report['invoice']);
    }

    public function testReportHasRequestedBy(){
        $this->record->load('requestedBy');
        $this->assertNotNull($this->report['requested_by']);
    }

/*
    public function testReportHasRecord(){
        $this->record->load('record');
        $this->assertNotNull($this->report['record']);
    }*/
}
