<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Filament\Notifications\Notification;

class ProcessProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function handle(): void
    {
        //  Toggle product name 
        $this->product->update([
            'name' => $this->product->name . ' ✅ Processed',
        ]);

        // Send notification 
        $user = User::first();
        if ($user) {
            Notification::make()
                ->title("Product {$this->product->name} processed!")
                ->sendToDatabase($user);
        }
    }
}

