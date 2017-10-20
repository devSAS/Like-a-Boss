<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function singupAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate("application/registration/singup");

        return $viewModel;
    }

    public function brandsAction()
    {
        return new ViewModel();
    }

    public function newAction()
    {
        return new ViewModel();
    }

    public function singinAction()
    {
        return new ViewModel();
    }
    public function catalogAction()
    {
        return new ViewModel();
    }
    public function saleAction()
    {
        return new ViewModel();
    }

}
