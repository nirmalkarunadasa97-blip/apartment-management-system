<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Reply;
use Illuminate\Http\Request;

class ResidentChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $userId = auth()->id();

        $conversationId = Chat::where('user_id', $userId)->pluck('chat_id')->first();

        $chats = Reply::where('chat_id', $conversationId)->get();

        return view('chat.add', compact('chats', 'conversationId'));
    }

    public function updateUserReadStatus()
    {
        Chat::where('user_read', 1)
            ->where('user_id', auth()->id())
            ->update([
                'user_read' => 2,
                'admin_read' => 2
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        try {

            $existingConversation = Chat::where('user_id', auth()->user()->id)->first();

            if ($existingConversation == null) {
                $conversation = new Chat();
                $conversation->admin_read = 1;
                $conversation->user_read = 2;
                $conversation->user_id = auth()->user()->id;
                $conversation->save();
                // dd($conversation);
                $chatId = $conversation->chat_id;
            } else {

                $chatId = $existingConversation->chat_id;

                $conversation = Chat::find($chatId);

                $conversation->admin_read = 1;
                $conversation->user_read = 2;
                $conversation->save();
            }

            $chat = new Reply();
            $chat->reply = $request->get('message');
            $chat->chat_id = $chatId;
            $chat->user_id = auth()->user()->id;
            $chat->save();

            return redirect()->back()->with('success_msg', 'Sent');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_msg', 'Something went wrong!');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
