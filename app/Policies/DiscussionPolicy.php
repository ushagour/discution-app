<?php

namespace App\Policies;

use App\Models\Discussion;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscussionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Discussion $discussion)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Discussion $discussion)
    {
        //

        return $user->profile->role == 'admin' || (auth()->check() && $discussion->user_id == auth()->id())
        ? Response::allow()
        : Response::deny('You do not own this DISCUSSION.');

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Discussion $discussion)
    {
        //
        return $user->id === $discussion->user_id
        ? Response::allow()
        : Response::deny('You do not own this DISCUSSION.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Discussion $discussion)
    {
        //
        return $user->profile->role == 'admin';

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Discussion $discussion)
    {
        return $user->profile->role == 'admin';
        //
    }
}
