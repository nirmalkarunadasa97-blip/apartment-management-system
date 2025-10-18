<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {



        $listdata = Chat::with(['user:id,name', 'replies'])
            ->select('chats.*')
            ->withCount('replies')
            ->groupBy('chats.chat_id')
            ->orderByRaw('chats.admin_read = 1 DESC')
            ->latest('chats.updated_at')
            ->get();


        return view('chat.index', compact('listdata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $conversationId = $request->query('chat_id');
        $chats = Reply::where('chat_id', $conversationId)->get();

        return view('chat.create', compact('chats', 'conversationId'));
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

            $chat = new Reply();
            $chat->reply = $request->get('message');
            $chat->chat_id = $request->get('chat_id');
            $chat->user_id = auth()->user()->id;
            $chat->save();

            $conversation = Chat::find($chat->chat_id);
            $conversation->admin_read = 2;
            $conversation->user_read = 1;
            $conversation->save();

            return redirect()->back()->with('success_msg', 'Sent');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_msg', 'Something went wrong!');
        }
    }

    public function updateRead($chat_id)
    {
        Chat::where('chat_id', $chat_id)->update([
            'admin_read' => 2,
            'user_read' => 2
        ]);

        return redirect()->route('admin_chat.create', ['chat_id' => $chat_id]);
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
