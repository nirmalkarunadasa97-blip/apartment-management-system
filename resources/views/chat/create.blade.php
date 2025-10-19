@extends('layer.app')

@section('content')
    <style>
        .direct-chat-primary .right>.direct-chat-text {
            background-color: #3b597a;
            border-color: #007bff;
            color: #fff;
        }
    </style>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Chat</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="col-md-6">
                <div class="card direct-chat-primary">

                    <div class="card-body">

                        @foreach ($chats as $chat)
                            <div class="direct-chat-msg @if ($chat->user_id == auth()->user()->id) left @else right @endif">
                                <div class="direct-chat-text">
                                    {{ $chat->reply }}
                                </div>

                            </div>
                        @endforeach

                        <div>
                            <form action="{{ route('admin_chat.store') }}" method="post" id="newuserform">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="message" placeholder="Type details ..."
                                        class="form-control">
                                    <span class="input-group-append">
                                        <input type="hidden" name="chat_id" value="{{ $conversationId }}">
                                        <button type="submit" class="btn btn-info">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
