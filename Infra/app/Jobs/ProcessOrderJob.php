<?php

namespace App\Jobs;

use Core\Services\Product\ProductService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ProcessOrderJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected readonly array $transaction,
        protected readonly string $transactionNumber,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Http::get(
            route('webhook.product.buy'),
            [
                'transaction_num' => $this->transactionNumber,
                'has_paid' => !! rand(0, 1)
            ]
        );
    }
}
