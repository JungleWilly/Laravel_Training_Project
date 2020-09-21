<?php

namespace App\Policies;

use App\Topicality;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicalityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->id === $topicality->user_id;
        
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Topicality  $topicality
     * @return mixed
     */
    public function view(User $user, Topicality $topicality)
    {
        return $user->id === $topicality->user_id;

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, int $topicality_user_id)
    {
        return $user->id === $topicality_user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Topicality  $topicality
     * @return mixed
     */
    public function update(User $user, Topicality $topicality)
    {
        return $user->id === $topicality->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Topicality  $topicality
     * @return mixed
     */
    public function delete(User $user, Topicality $topicality)
    {
        return $user->id === $topicality->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Topicality  $topicality
     * @return mixed
     */
    public function restore(User $user, Topicality $topicality)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Topicality  $topicality
     * @return mixed
     */
    public function forceDelete(User $user, Topicality $topicality)
    {
        //
    }
}
