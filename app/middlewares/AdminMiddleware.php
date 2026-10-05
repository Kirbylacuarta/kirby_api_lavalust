<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AdminMiddleware
{
    public function handle($next)
    {
        $session = load_class('session', 'libraries');

        if (!$session->has_userdata('user_id')) {
            header('Location: ' . site_url('/login'));
            exit;
        }

        if ($session->userdata('user_role') !== 'admin') {
            show_error('403 Forbidden', 'Administrator access is required for this action.', 'error_general', 403);
            exit;
        }

        return $next();
    }
}