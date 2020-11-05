<?php

namespace App\Mail;

use App\Http\Requests\BackEnd\Messages\Store;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;


class ReplayContact extends Mailable
{

    protected $message;
    protected $replay;


    public function __construct($message, $replay)
    {
        $this->message=$message;
        $this->replay=$replay;
    }

    public function replay($id, Store $request)
    {
        $message = $this->model->findOrFail($id);
        Mail::send(new ReplayContact($message, $request->message));
        return redirect()->route('messages.edit', ['id' => $message->id]);
    }
}
