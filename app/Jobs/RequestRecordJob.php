<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Faker\Generator as Faker;
use Faker\Factory;

use App\Notifications\RecordCompleted;

class RequestRecordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $record;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(\App\Record $record)
    {
        $this->record = $record;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $record = $this->record;

        $record->load('business', 'createdBy');
        $user = $record->createdBy;

        //TODO::implement record request to an actual provider

        $this->record = factory(\App\Record::class)
            ->create([
                'first_name' => $record->first_name,
                'middle_name' => $record->middle_name,
                'last_name' => $record->last_name,
                'dob' => $record->dob,
                'ssn' => '***-**-****'
            ]);

        $user->notify(new RecordCompleted($record));
        //Notification::send($users, new RecordCompleted($record));



    }
}
