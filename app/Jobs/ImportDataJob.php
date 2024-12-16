<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\User;

class ImportDataJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */

     private $user_Id;

    public function __construct($user_Id)
    {
       $this->user_Id = $user_Id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $user_Ids = $this->user_Id;
        foreach($user_Ids as $id)
        {
            User::where('id', $id)->update([
                'status' => 0 ,
            ]);
        }
    }
}
