<?php

namespace App\Console\Commands;

use App\Models\Attancance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MarkAbsentEmployees extends Command
{

    /**
     * The name and signature of the console command.
     *  
     * @var string
     */
    protected $signature = 'attendance:mark-absent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically mark absent employees who did not mark attendance before 5 PM';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $this->info('Starting attendance check at ' . Carbon::now());
        $today = Carbon::today()->toDateString();

        // Get all users
        $users = User::all();
        $this->info('Total Users: ' . $users->count());

        foreach ($users as $user) {
            $this->info('Checking attendance for user: ' . $user->name);

            $alreadyMarked = Attancance::where('user_id', $user->id)
                ->whereDate('created_at', $today)
                ->exists();

                if (!$alreadyMarked) {
                    Attancance::create([
                        'user_id' => $user->id,
                        'status' => 'A',
                    ]);
                    $this->info("Marked Absent: {$user->name}");
                } else {
                    $this->info("Already marked attendance for: {$user->name}");
                }
        }

        $this->info('Absent marking complete.');
        return Command::SUCCESS;
    }
}
