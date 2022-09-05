<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendCancelledOrderDetails extends Mailable
{
    use Queueable, SerializesModels;
    public $orderId;
    public $bookName;
    public $bookAuthor;
    public $bookPrice;
    public $quantity;
    public $totalPrice;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($getUser, $order, $book)
    {
        $this->bookName = $book->name;
       
        
        $this->bookAuthor = $book->author;
        $this->bookPrice = $book->price;
        $this->quantity = $book->quantity;
        $this->totalPrice = $order->total_price;
        $this->user = $getUser->first_name;
        $this->orderId = $order->order_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('cancelledOrderDetails')->with([
            // 'token' => $this->token,
            // 'email' => $this->email
            'user' => $this->user,
            'orderId' => $this->orderId,
            'bookName' => $this->bookName,
            'bookAuthor' => $this->bookAuthor,
            'bookPrice' => $this->bookPrice,
            'quantity' => $this->quantity,
            'totalPrice' => $this->totalPrice
        ]);
    }
}