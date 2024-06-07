<?php

namespace App\Console\Commands;

use App\Models\Coupon;
use Illuminate\Console\Command;

class DeactivateExpiredCoupon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coupons:deactivate-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate all active expired coupons';

    /**
     * Execute the console command.
     */ public function handle()
    {

        $expiredCoupons = Coupon::whereDate('expiration_date', '<', date("Y-m-d"))->where("status", true)->get();

        if (!$expiredCoupons->count()) {
            return 0;
        }

        foreach ($expiredCoupons as $coupon) {
            $coupon->update(['status' => false]);
            $this->info('Coupon deactivated: ' . $coupon->code);
        }

        $this->info('Expired coupons deactivated successfully.');
    }
}
