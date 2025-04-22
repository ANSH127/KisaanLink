<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\ProductDetail;
use Carbon\Carbon;

class CancelUnpaidOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:cancel-unpaid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel unpaid orders after 24 hours and restore product quantity';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $orders = Order::where('status', 'Accepted')
            ->where('payment_status', 'Pending')
            ->where('updated_at', '<=', Carbon::now()->subHours(24))
            ->get();
        
        foreach ($orders as $order) {
            // Restore product quantity
            $product=$order->product;
            if($product){
                $product->quantity += $order->quantity;
                $product->save();
            }
            // update the order status
            $order->status = "Cancelled";
            $order->payment_status = "Failed";
            $order->cancel_reason = "Order cancelled due to non-payment after 24 hours";
            $order->save();
            // Log the cancellation
            $this->info("Order ID {$order->id} has been cancelled and product quantity restored.");

        }
        // Log the completion of the command
        $this->info('All unpaid orders older than 24 hours have been cancelled and product quantities restored.');

    }
}
