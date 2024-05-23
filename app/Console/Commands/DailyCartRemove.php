<?php

namespace App\Console\Commands;

use App\Models\Cart;
use App\Models\PhoneDetails;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DailyCartRemove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-cart-remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run task DailyCartRemove';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $carts = Cart::where('updated_at', '<=', Carbon::now()->subHours(24));
        $list = Cart::where('updated_at', '<=', Carbon::now()->subHours(24))->get();
        foreach ($list as $cart) {
            $details = PhoneDetails::where('phone_details_id', '=', $cart->phone_details_id)->first();
            $details->update([
                'quantity' => $details->quantity + $cart->quantity
            ]);
        }
        $carts->delete();
    }
}
