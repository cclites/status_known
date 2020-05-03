<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

use Tests\TestCase;

class BusinessRelationsTest extends TestCase
{
    use RefreshDatabase;

    public $business;
    public $user;
    public $record;
    public $account;
    public $invoice;
    public $report;

    protected function setUp() : void
    {
        parent::setUp();

        echo "\nBusiness Relations Test\n";

        $this->business = factory(\App\Business::class)->create();
        $this->provider = factory(\App\Provider::class)->create();
        $this->user = factory(\App\User::class)->create(['business_id'=> $this->business['id']]);
        $this->record = factory(\App\Record::class)->create(['business_id'=> $this->business['id'], 'created_by_id'=> $this->user['id'], 'provider_id'=>$this->provider['id']]);
        $this->report = factory(\App\Report::class)->create(['business_id'=> $this->business['id'],  'requested_by_id' => $this->user['id'], 'tracking' => $this->record['tracking'], 'record_id' => $this->record['id']]);
        $this->invoice = factory(\App\Invoice::class)->create(['business_id'=> $this->business['id'], 'tracking' => $this->record['tracking']]);
        $this->account = factory(\App\Account::class)->create(['business_id'=> $this->business->id, 'tracking' => $this->record['tracking']]);
    }

    public function testBusinessHasUser(){
        $this->business->load('users');
        $this->assertNotNull($this->business['users']);
    }


    public function testHasResponsibleUser(){
        $this->business->load('responsibleAgent');
        $this->assertNotNull($this->business['responsible_agent_id']);
    }

    public function testBusinessHasRecords(){
        $this->business->load('records');
        $this->assertNotNull($this->business['records']);
    }

    public function testBusinessHasReports(){
        $this->business->load('reports');
        $this->assertNotNull($this->business['reports']);
    }

    public function testBusinessHasInvoices(){
       $this->business->load('invoices');
       $this->assertNotNull($this->business['invoices']);
    }

    public function testBusinessHasAccount(){
       $this->business->load('account');
       $this->assertNotNull($this->business['account']);
    }
}
