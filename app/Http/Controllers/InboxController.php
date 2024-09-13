<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;


class InboxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Conversation $conversation) {
        [$conversations, $unused] = Auth::user()->contact->conversationsApi();

        $seo = (object) [
            'title' => 'Inbox - InnovRental'
        ];

        return view('themes.tailwind.inbox.index', [
            'conversations' => $conversations,
            'seo' => $seo
        ]);
    }

    public function show(Conversation $conversation) {
        $this->authorize('view', $conversation);

        $seo = (object) [
            'title' => 'Inbox - InnovRental'
        ];

        return view('themes.tailwind.inbox.show', [
            'seo' => $seo
        ]);
    }
}
