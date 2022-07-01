<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\PodsjetnikPolaganje;
use App\Models\Zaposleni;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class Podsjetnik implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $zaposleni;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Zaposleni $zaposleni)
    {
        $this->zaposleni = $zaposleni;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to('luka.abazovic@cedis.me')->send(new PodsjetnikPolaganje($this->zaposleni));
    }
}
