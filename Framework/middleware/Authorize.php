<?php

namespace Framework\Middleware;

use Framework\Session;

class Authorize
{
    /**
     * Check if user is authenticated
     * 
     * @return bool
     */
    public function isAuthenticated()
    {
        return Session::has('user');
    }


    /**
     * Handle the user's request
     * 
     * @param string $role
     * @return bool
     */
    public function handle($role)
    {
        // If the resource is meant for guest but user is Authenticated, redirect to home page
        if ($role === 'guest' && $this->isAuthenticated()) {
            return redirect('/');
            // Else if the resource is for authenticated users and user is not, redirect to login page
        } elseif ($role === 'auth' && !$this->isAuthenticated()) {
            return redirect('/auth/login');
        }
    }
}
