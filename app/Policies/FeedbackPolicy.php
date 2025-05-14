<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Feedback;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedbackPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Feedback $feedback)
    {
        return $user->id === $feedback->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Feedback $feedback)
    {
        return $user->id === $feedback->user_id;
    }
}