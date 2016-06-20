<?php

namespace Uph\Miklaj\Controller;

use \PDO;
use Uph\Miklaj\Core\View;
use Uph\Miklaj\Core\Request;
use Uph\Miklaj\Core\TextResponse;
use Uph\Miklaj\Template\TemplateEngine;
use Uph\Miklaj\Repositories\UserRepository;
use Uph\Miklaj\Auth;

class UserController
{
    protected $template;
    protected $repo;
    protected $auth;

    public function __construct(TemplateEngine $template, UserRepository $repo, Auth $auth)
    {
        $this->template = $template;
        $this->repo = $repo;
        $this->auth = $auth;
    }

    public function index(Request $request)
    {
        $obj_list = $this->repo->getAll();
        return $this->template->render('user/list', compact('obj_list'));
    }

    public function detail(Request $request)
    {
        $id = $request->router_data[1];
        $obj = $this->repo->get($id);
        return $this->template->render('user/detail', compact('obj'));
    }


    public function create(Request $request)
    {
        return $this->template->render('user/create');
    }

    public function store(Request $request)
    {
        $data = $request->post;
        if (!$data) {
            echo "1";
            return $this->template->render('user/create');
        }
        if (!isset($data['name']) || !isset($data['login']) || !isset($data['password']) || !isset($data['password2'])) {
            echo "2@";
            return $this->template->render('user/create');
        }
        if (empty($data['name']) || empty($data['login']) || empty($data['password']) || empty($data['password2'])) {
            echo "2";
            return $this->template->render('user/create');
        }
        // if (!preg_match(AUTH::REGEXP_PATTERN, $data['password'])) {
        //     echo "3";
        //     return $this->template->render('user/create');
        // }
        if ($data['password'] != $data['password2']) {
            echo "4";
            return $this->template->render('user/login');
        }

        $this->repo->insert($data);
        echo '<script>document.location = \'/\'</script>';
    }

    public function login(Request $request)
    {
        $data = $request->post;
        if (!$data) {
            return $this->template->render('user/login');
        }

        if (!isset($data['login']) || !isset($data['password'])) {
            return $this->template->render('user/login');
        }

        $login = $data['login'];
        $password = $data['password'];

        if (!$this->auth->authenticate($login, $password)) {
            return $this->template->render('user/login');
        }

        echo '<script>document.location = \'/\'</script>';
    }

    public function logout(Request $request)
    {
        $this->auth->logout();
        echo '<script>document.location = \'/\'</script>';
    }




    // public function edit(Request $request)
    // {
    //     $id = $request->router_data[1];
    //     $obj = $this->repo->get($id);
    //     return $this->template->render('category/edit', compact('obj'));
    // }

    // public function update(Request $request)
    // {
    //     $id = $request->router_data[1];
    //     $data = $request->post;
    //     $obj = $this->repo->update($id, $data);
    //     return $this->index($request);
    // }

    // public function delete(Request $request)
    // {
    //     $category_id = $request->router_data[1];
    //     $obj = $this->repo->delete($category_id);
    //     return $this->index($request);
    // }
}
