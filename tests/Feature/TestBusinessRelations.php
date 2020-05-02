<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

use Tests\TestCase;

class TestBusinessRelations extends TestCase
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

        $this->business = factory(\App\Business::class)->create();
        $this->user = factory(\App\User::class)->create(['business_id'=> $this->business->id]);
        $this->record = factory(\App\Record::class)->create(['business_id'=> $this->business->id]);

        $this->report = factory(\App\Report::class)->create(['business_id'=> $this->business->id
        , 'record_id' => $this->record['id'], 'tracking' => $this->record['tracking']]);

        $this->invoice = factory(\App\Invoice::class)->create(['business_id'=> $this->business->id, 'tracking' => $this->record['tracking']]);
        $this->account = factory(\App\Account::class)->create(['business_id'=> $this->business->id, 'tracking' => $this->record['tracking']]);

        $this->assertNotNull($this->business, "Setup Failed");
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
