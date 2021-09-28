<?php

namespace App\Jobs;

use App\Models\Sales;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SalesCsvProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $data;
    public $header;
    public function __construct($data, $header)
    {
        $this->data  = $data;
        $this->header  = $header;
    }


    public function handle()
    {
        foreach ($this->data as $sale) {
            $salesData = array_combine($this->header, $sale);
            Sales::create($salesData);
        }
    }
}
