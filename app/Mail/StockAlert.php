<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StockAlert extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $itemName;

    public function __construct($itemName)
    {
        $this->itemName = $itemName;
    }

    public function build()
    {
        return $this->subject('Stock Alert')
            ->view('emails.stock_alert')
            ->with(['itemName' => $this->itemName]);
    }
}
