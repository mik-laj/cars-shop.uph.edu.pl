<?php

namespace Uph\Miklaj\Controller;

use Uph\Miklaj\Core\View;
use Uph\Miklaj\Core\Request;
use Uph\Miklaj\Template\TemplateEngine;
use Uph\Miklaj\Repositories\OrderRepository;
use Uph\Miklaj\Repositories\OrderItemRepository;
use Uph\Miklaj\Repositories\ProductVariantRepository;
use Uph\Miklaj\Auth;

class OrderController
{
    protected $template;
    protected $auth;
    protected $order;
    protected $order_item;
    protected $variant;

    public function __construct(
        TemplateEngine $template,
        Auth $auth,
        OrderRepository $order,
        OrderItemRepository $order_item,
        ProductVariantRepository $variant
    ) {
        $this->template = $template;
        $this->auth = $auth;
        $this->order = $order;
        $this->order_item = $order_item;
        $this->variant = $variant;
    }

    public function index(Request $request)
    {
        if($this->auth->isAdmin()){
            $obj_list = $this->order->getAll();
        }else{
            $obj_list = $this->order->getAllForUser($this->auth->getUser()->id);
        }
        return $this->template->render('order/list', compact('obj_list'));
    }

    public function detail(Request $request)
    {
        $id = $request->router_data[1];
        $obj = $this->order->get($id);
        $obj_list = $this->order->getWithProductsInfo($id);
        return $this->template->render('order/detail', compact('obj', 'obj_list'));
    }

    public function create(Request $request){
        $variant_id = $request->get['variant_id'];
        return $this->template->render('order/create', compact('variant_id'));
    }

    public function store(Request $request)
    {
        $variant_id = $request->post['variant_id'];
        $variant = $this->variant->get($variant_id);

        $order_id = $this->order->insert([
            'price' => $variant->price,
            'user_id' => $this->auth->getUser()->id,
            'note' => 'Order submited',
            'comment' => $request->post['comment'],
            'line_1' => $request->post['line_1'],
            'line_2' => $request->post['line_2'],
            'line_3' => $request->post['line_3'],
            'city' => $request->post['city'],
            'zip_or_province' => $request->post['zip_or_province'],
            'country' => $request->post['country']
        ]);

        $order_item_id = $this->order_item->insert([
            'product_variant_id' => $variant_id,
            'order_id' => $order_id,
            'price' => $variant->price
        ]);

        return $this->index($request);
    }


    public function edit(Request $request)
    {
        $id = $request->router_data[1];
        $obj = $this->order->get($id);
        return $this->template->render('order/edit', compact('obj'));
    }

    public function update(Request $request)
    {
        $id = $request->router_data[1];
        $data = ['note' => $request->post['note']];
        $obj = $this->order->update($id, $data);
        return $this->index($request);
    }
}
