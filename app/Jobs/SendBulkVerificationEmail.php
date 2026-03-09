<?php

namespace App\Jobs;

use App\Models\Pendaftaran;
use App\Mail\PendaftaranDiterima;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendBulkVerificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $pendaftaran;

    /**
     * Create a new job instance.
     *
     * @param Pendaftaran $pendaftaran
     */
    public function __construct(Pendaftaran $pendaftaran)
    {
        $this->pendaftaran = $pendaftaran;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Pastikan relasi jurusan dimuat sebelum mengirim email
        $this->pendaftaran->load('jurusanRelasi');
        Mail::to($this->pendaftaran->email)->send(new PendaftaranDiterima($this->pendaftaran));
    }
}
