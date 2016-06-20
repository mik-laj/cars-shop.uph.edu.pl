<?php

namespace Uph\Miklaj;

use \PDO;
use Uph\Miklaj\Core\Request;
use Uph\Miklaj\Router\Router;
use Uph\Miklaj\Router\RegExpRoute;
use Uph\Miklaj\Template\TemplateEngine;

class App
{
    protected $pdo;
    protected $request;
    protected $template;
    protected $router;
    protected $reporitories;
    protected $auth;

    public function database()
    {
        $host = '127.0.0.1';
        $db   = 'cars_shop_uph_edu_pl';
        $user = 'root';
        $pass = '';
        $charset = 'utf8';

        $dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new PDO($dsn, $user, $pass, $opt);
    }

    public function request()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $_SERVER['REQUEST_URI'];
        $post = $_POST;
        $get = $_GET;
        $session = new Core\Session();
        $this->request = new Request($method, $path, $post, $get, $session);
    }

    public function repositories()
    {
        $this->repositories = [
            'category' => new Repositories\CategoryRepository($this->pdo),
            'product' => new Repositories\ProductRepository($this->pdo),
            'product_variant' => new Repositories\ProductVariantRepository($this->pdo),
            'order' => new Repositories\OrderRepository($this->pdo),
            'order_item' => new Repositories\OrderItemRepository($this->pdo),
            'user' => new Repositories\UserRepository($this->pdo)
        ];
    }

    public function authenticator()
    {
        $this->auth = new Auth(
            $this->request,
            $this->repositories['user']
        );
    }

    public function template()
    {
        $this->template = new TemplateEngine(ABS_PATH . DIRECTORY_SEPARATOR . 'templates');

        $this->template->addData([
            'repos' => $this->repositories,
            'auth' => $this->auth,
            'request' => $this->request,
        ]);

        $this->template->registerFunction('truncate', function ($string) {
            return substr($string, 0, strrpos(substr($string, 0, 200), ' '));
        });
    }

    public function router()
    {
        $router = new Router();

        // Home Controller
        $home_controller = new Controller\HomePageController($this->template);
        $router->setDefault([$home_controller, 'index']);

        // Category Controller
        $category_controller = new Controller\CategoryController(
            $this->template,
            $this->repositories['category']
        );

        $router->get(new RegExpRoute('/\/category\/$/', [$category_controller, 'index']));
        $router->get(new RegExpRoute('/\/category\/([0-9]+)$/', [$category_controller, 'detail']));
        $router->get(new RegExpRoute('/\/category\/create$/', [$category_controller, 'create']));
        $router->post(new RegExpRoute('/\/category\/create$/', [$category_controller, 'store']));
        $router->get(new RegExpRoute('/\/category\/([0-9]+)\/edit$/', [$category_controller, 'edit']));
        $router->post(new RegExpRoute('/\/category\/([0-9]+)\/edit$/', [$category_controller, 'update']));
        $router->post(new RegExpRoute('/\/category\/([0-9]+)\/delete$/', [$category_controller, 'delete']));

        // Product controller
        $product_controller = new Controller\ProductController(
            $this->template,
            $this->repositories['product'],
            $this->repositories['product_variant']
        );

        $router->get(new RegExpRoute('/\/product\/$/', [$product_controller, 'index']));
        $router->get(new RegExpRoute('/\/product\/([0-9]+)$/', [$product_controller, 'detail']));
        $router->get(new RegExpRoute('/\/product\/create$/', [$product_controller, 'create']));
        $router->post(new RegExpRoute('/\/product\/create$/', [$product_controller, 'store']));
        $router->get(new RegExpRoute('/\/product\/([0-9]+)\/edit$/', [$product_controller, 'edit']));
        $router->post(new RegExpRoute('/\/product\/([0-9]+)\/edit$/', [$product_controller, 'update']));
        $router->post(new RegExpRoute('/\/product\/([0-9]+)\/delete$/', [$product_controller, 'delete']));

        // Product's variant controller
        $product_variant_controller = new Controller\ProductVariantController(
            $this->template,
            $this->repositories['product_variant']
        );

        $router->get(new RegExpRoute('/\/product\/([0-9]+)\/variants$/', [$product_variant_controller, 'index']));
        $router->get(new RegExpRoute('/\/product\/([0-9]+)\/([0-9]+)$/', [$product_variant_controller, 'detail']));
        $router->get(new RegExpRoute('/\/product\/([0-9]+)\/([0-9]+)\/api$/', [$product_variant_controller, 'detailApi']));
        $router->get(new RegExpRoute(
            '/\/product\/([0-9]+)\/create-variant$/',
            [$product_variant_controller, 'create']
        ));
        $router->post(new RegExpRoute(
            '/\/product\/([0-9]+)\/create-variant$/',
            [$product_variant_controller, 'store']
        ));
        $router->get(new RegExpRoute('/\/product\/([0-9]+)\/([0-9]+)\/edit$/', [$product_variant_controller, 'edit']));
        $router->post(new RegExpRoute(
            '/\/product\/([0-9]+)\/([0-9]+)\/edit$/',
            [$product_variant_controller, 'update']
        ));
        $router->post(new RegExpRoute(
            '/\/product\/([0-9]+)\/([0-9]+)\/delete$/',
            [$product_variant_controller, 'delete']
        ));

        $user_controller = new Controller\UserController(
            $this->template,
            $this->repositories['user'],
            $this->auth
        );

        $router->get(new RegExpRoute('/\/user\/$/', [$user_controller, 'index']));
        $router->get(new RegExpRoute('/\/user\/([0-9]+)$/', [$user_controller, 'detail']));
        $router->get(new RegExpRoute('/\/user\/create$/', [$user_controller, 'create']));
        $router->post(new RegExpRoute('/\/user\/create$/', [$user_controller, 'store']));
        $router->post(new RegExpRoute('/\/user\/login$/', [$user_controller, 'login']));
        $router->post(new RegExpRoute('/\/user\/logout$/', [$user_controller, 'logout']));
        // $router->get(new RegExpRoute('/\/product\/([0-9]+)\/edit$/', [$user_controller, 'edit']));
        // $router->post(new RegExpRoute('/\/product\/([0-9]+)\/edit$/', [$user_controller, 'update']));
        // $router->post(new RegExpRoute('/\/product\/([0-9]+)\/delete$/', [$user_controller, 'delete']));

        $order_controller = new Controller\OrderController(
            $this->template,
            $this->auth,
            $this->repositories['order'],
            $this->repositories['order_item'],
            $this->repositories['product_variant']
        );
        $router->get(new RegExpRoute('/\/order\/$/', [$order_controller, 'index']));
        $router->get(new RegExpRoute('/\/order\/([0-9]+)$/', [$order_controller, 'detail']));
        $router->get(new RegExpRoute('/\/order\/create$/', [$order_controller, 'create']));
        $router->post(new RegExpRoute('/\/order\/create$/', [$order_controller, 'store']));
        $router->get(new RegExpRoute('/\/order\/([0-9]+)\/edit$/', [$order_controller, 'edit']));
        $router->post(new RegExpRoute('/\/order\/([0-9]+)\/edit$/', [$order_controller, 'update']));


        $this->router = $router;
    }

    public function bootstrap()
    {

        // 1. Enable session
        session_start();

        // 2. Construct depedencies
        $this->request();
        $this->database();
        $this->repositories();
        $this->authenticator();

        $this->template();
        $this->router();

        // 3. Get View
        $route = $this->router->findRoute($this->request);
        $response = call_user_func_array($route, [$this->request]);

        // 4. Display response
        echo $response;


    }
}
