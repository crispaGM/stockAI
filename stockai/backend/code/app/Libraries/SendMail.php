<?php


namespace App\Libraries;



use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $view;
    public $data;

    /**
     * Create a new message instance.
     *
     * @param [type] $view [description]
     * @param [type] $data [description]
     *
     * @return void
     */
    public function __construct($view, $data)
    {
        $this->view = $view;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown($this->view)
            ->to($this->data->email)
            ->subject($this->data->subject)
            ->with(['content' => $this->data ]);
    }
}
