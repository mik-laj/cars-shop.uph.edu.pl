<?php

namespace Uph\Miklaj\Controller;

use \PDO;
use Uph\Miklaj\Core\View;
use Uph\Miklaj\Core\Request;
use Uph\Miklaj\Core\TextResponse;
use Uph\Miklaj\Template\TemplateEngine;
use Uph\Miklaj\Repositories\ProductVariantRepository;

class ProductVariantController
{
    protected $template;
    protected $repo;

    public function __construct(TemplateEngine $template, ProductVariantRepository $repo)
    {
        $this->template = $template;
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        $product_id = $request->router_data[1];
        $obj_list = $this->repo->getAllForProductId($product_id);
        return $this->template->render('product_variant/list', compact('product_id', 'obj_list'));
    }

    public function detail(Request $request)
    {
        $product_id = $request->router_data[1];
        $id = $request->router_data[2];
        $obj = $this->repo->get($id);
        return $this->template->render('product_variant/detail', compact('product_id', 'obj'/*, 'obj_list'*/));
    }

    public function detailApi(Request $request)
    {
        $id = $request->router_data[2];
        $obj = $this->repo->get($id);
        return json_encode([
            'result' => true,
            'data' => $obj
        ]);
    }


    public function create(Request $request)
    {
        $product_id = $request->router_data[1];
        return $this->template->render('product_variant/create', compact('product_id'));
    }

    public function store(Request $request)
    {
        $product_id = $request->router_data[1];
        $data = $request->post;
        if (isset($data) && !empty($data['name'])) {
            $data['product_id'] = $product_id;
            $this->repo->insert($request->post);
            return $this->index($request, compact('product_id'));
        }
        return $this->template->render('product_variant/create', compact('product_id'));
    }

    public function edit(Request $request)
    {
        $product_id = $request->router_data[1];
        $id = $request->router_data[2];
        $obj = $this->repo->get($id);
        return $this->template->render('product_variant/edit', compact('product_id', 'obj'));
    }

    public function update(Request $request)
    {
        $product_id = $request->router_data[1];
        $id = $request->router_data[2];
        $data = $request->post;
        $obj = $this->repo->update($id, $data);
        return $this->index($request, compact('product_id'));
    }

    public function delete(Request $request)
    {
        $product_id = $request->router_data[1];
        $id = $request->router_data[2];
        $obj = $this->repo->delete($id);
        return $this->index($request);
    }
}
