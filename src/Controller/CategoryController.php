<?php

namespace Uph\Miklaj\Controller;

use \PDO;
use Uph\Miklaj\Core\View;
use Uph\Miklaj\Core\Request;
use Uph\Miklaj\Core\TextResponse;
use Uph\Miklaj\Template\TemplateEngine;
use Uph\Miklaj\Repositories\CategoryRepository;

class CategoryController
{
    protected $template;
    protected $repo;

    public function __construct(TemplateEngine $template, CategoryRepository $repo)
    {
        $this->template = $template;
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        $obj_list = $this->repo->getAll();
        return $this->template->render('category/list', compact('obj_list'));
    }

    public function detail(Request $request)
    {
        $id = $request->router_data[1];
        $obj = $this->repo->get($id);
        $obj_list = $this->repo->getCategoryProducts($id);
        return $this->template->render('category/detail', compact('obj', 'obj_list'));
    }

    public function create(Request $request)
    {
        return $this->template->render('category/create');
    }

    public function store(Request $request)
    {
        $data = $request->post;
        if (isset($data) && !empty($data['name'])) {
            $this->repo->insert($request->post);
            return $this->index($request);
        }
        return $this->template->render('category/create');
    }

    public function edit(Request $request)
    {
        $id = $request->router_data[1];
        $obj = $this->repo->get($id);
        return $this->template->render('category/edit', compact('obj'));
    }

    public function update(Request $request)
    {
        $id = $request->router_data[1];
        $data = $request->post;
        $obj = $this->repo->update($id, $data);
        return $this->index($request);
    }

    public function delete(Request $request)
    {
        $category_id = $request->router_data[1];
        $obj = $this->repo->delete($category_id);
        return $this->index($request);
    }
}
