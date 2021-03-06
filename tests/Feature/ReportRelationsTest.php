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
    public $report;
    public $invoice;

    protected function setUp() : void
    {
        parent::setUp();

        echo "\nReport Relations Test\n";

        $this->business = factory(\App\Business::class)->create();
        $this->provider = factory(\App\Provider::class)->create();
        $this->user = factory(\App\User::class)->create(['business_id'=> $this->business['id']]);
        $this->record = factory(\App\Record::class)->create(['business_id'=> $this->business['id'], 'created_by_id'=> $this->user['id'], 'provider_id'=>$this->provider['id']]);
        $this->report = factory(\App\Report::class)->create(['business_id'=> $this->business['id'],  'requested_by_id' => $this->user['id'], 'tracking' => $this->record['tracking'], 'record_id' => $this->record['id']]);
        $this->invoice = factory(\App\Invoice::class)->create(['business_id'=> $this->business['id'], 'tracking' => $this->record['tracking']]);

    }

    public function testReportHasBusiness(){
        $this->report->load('business');
        $this->assertNotNull($this->report['business']);
    }

    public function testReportHasRecord(){
        $this->report->load('record');
        $this->assertNotNull($this->report['record']);
    }

    public function testReportHasRequestedBy(){
        $this->report->load('requested_by');
        $this->assertNotNull($this->report['requested_by']);
    }



}
