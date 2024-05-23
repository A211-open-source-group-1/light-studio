<?php

namespace App\Console\Commands;

use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DailyTokenRemove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-token-remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run task DailyTokenRemove';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Token::where('created_at', '<=', Carbon::now()->subHours(24))->delete();
    }
}
