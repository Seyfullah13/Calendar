<?php

namespace App\Policies;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ContactPolicy
{
    /**
     * Determine whether the user can view the model.
     * The user can view only the contact profile if they are in a same conversation.
     * The user can view their own contact profile
     */
    public function view(User $user, Contact $contact): Response
    {
        $condition = ($user->contact->contactsQuery()->where('id', '=', $contact->id)->first()) !== null;

        return $condition || ($user->contact->id === $contact->id) ? Response::allow() : Response::denyAsNotFound();
    }
}
