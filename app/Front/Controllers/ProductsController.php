<?php namespace Phasty\Front\Controllers;


use Phasty\Common\Models\Products;

class ProductsController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->tag->setTitle('Product | Phasty');
    }

    /**
     * just forward to catalog
     */
    public function indexAction()
    {
        $this->dispatcher->forward([
            'controller' => 'catalog',
            'view' => 'index'
        ]);
    }

    public function showAction($slug = '')
    {
        $product = Products::findFirstBySlug($slug);
        if(!$product){
            $this->flashSession->error('There is no such a product');
            return $this->response->redirect('catalog');
        }
        $this->view->setVars([
            'product' => $product,
            'images' => $product->getImages(true),
            'reviews' => $product->reviews ? $product->reviews : null
        ]);
    }

    /**
     * 获取
     */
    public function NewArrivalsAction()
    {
        $this->assets->addCss('/assets/css/new_arrivals.min-1d6608f62e.css');

    }

}