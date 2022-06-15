<?php

namespace App\Console\Commands;

use App\Models\Pet;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class PostDurationLimit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'limit:weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'freeze post if the post age is 7days';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pets = Pet::where('is_active', 1)->get();
        foreach($pets as $pet) {
            $active_duration = Carbon::now()->diffInDays($pet->last_date_activated);
            if($active_duration > 7) {
                $pet->is_active = 0;
                $pet->announcement_status = 'frozen';
                $pet->save();
            }
        }
        $this->info('Successfully updated database for expired posts.');
    }
}
