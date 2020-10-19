<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Events\MessageSent;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chats');
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $message = auth()->user()->messages()->create([
            'message' => $request->message
        ]);

        broadcast(new MessageSent($message->load('user')))->toOthers();

        return ['status' => 'success'];
    }

    public function customerChatView() {
        return view('chat.customerChat');
    }

    public function adminChatView() {
        return view('chat.adminChat');
    }

    /**
     * Persist message to database from admin
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessageFromAdmin(Request $request)
    {
        $user = Auth::user();

        $message = ChatMessages::create([
        'message' => $request->message,
        'tunnel_id' => $request->message_id,
        'sender_id' => $user->id,
        'sender_type' => 99,
        ]);

        return ['status' => 'Message Sent!'];
    }

    /**
     * Persist message to database from customer
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessageFromCustomer(Request $request)
    {
        // dd($request);
        $message = ChatMessages::create([
        'message' => $request->message,
        'tunnel_id' => $request->message_id,
        'sender_type' => 0,
        ]);

        return ['status' => 'Message Sent!'];
    }       
}
