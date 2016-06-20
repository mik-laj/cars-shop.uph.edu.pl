<?php
namespace Uph\Miklaj;

class Auth
{
    // Two uppercase lettern
    // One special characters1
    // two digits.
    // three lowercase letters.
    // total length 8
    const REGEXP_PATTERN = '^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8}$';
    protected $session;
    protected $repo;
    protected $current_user;
    protected $is_cached = false;

    public function __construct($request, $repo)
    {
        $this->session = $request->session;
        $this->repo = $repo;
    }

    public function getUser()
    {
        if ($this->isLogged()) {
            if (!$this->is_cached) {
                $this->queryForCurrentUser();
            }
            return $this->current_user;
        }
        return null;
    }

    public function checkCredentials($login, $password)
    {
        return $this->repo->getUserByLoginAndPassword($login, $password);
    }

    public function logout()
    {
        if ($this->isLogged()) {
            unset($this->session['current_user_id']);
        }
    }

    public function authenticate($login, $password)
    {
        $user = $this->checkCredentials($login, $password);
        if ($user) {
            $this->session['current_user_id'] = $user->id;
            $this->current_user = $user;
            $this->is_cached = true;
            return true;
        }
        return false;
    }

    private function queryForCurrentUser()
    {
        $this->current_user = $this->repo->get($this->session['current_user_id']);
        $this->is_cached = true;
    }

    public function isLogged()
    {
        return !empty($this->session['current_user_id']);
    }

    public function isAdmin()
    {
        return $this->isLogged() && $this->getUser()->role == 'admin';
    }

    public function isUser()
    {
        return $this->isLogged() && $this->getUser()->role != 'admin';
    }

    public function isGuest()
    {
        return !$this->isLogged();
    }
}
