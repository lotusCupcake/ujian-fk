<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Modules\ManajemenAkun\Models\ManajemenAkunModel;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    protected $manajemenAkunModel;
    protected $emailUser;
    protected $usr;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['user', 'validation'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    public function fetchMenu()
    {
        $this->manajemenAkunModel = new ManajemenAkunModel();
        $usr = $this->manajemenAkunModel->getSpecificUser(['users.id' => user()->id])->getResult()[0];
        $this->emailUser = $usr->email;

        // dd($usr);
        $data = file_get_contents(ROOTPATH . $this->getFile($usr->name));

        $data = json_decode($data, false);

        $titles = [];
        $parents = [];
        $childs = [];

        foreach ($data as $resource) {
            if ($resource->parent == 0 && $resource->level == 'title') {
                $titles[] = $resource;
            }

            if ($resource->parent != 0 && $resource->level == 'parent') {
                $parents[] = $resource;
            }

            if ($resource->parent != 0 && $resource->level == 'child') {
                $childs[] = $resource;
            }
        }

        $menu = "";
        foreach ($titles as $title) {
            $menu .= '<li class="sidebar-title">' . $title->nama . '</li>';

            foreach ($parents as $parent) {
                if ($title->id == $parent->parent) {
                    if ($parent->status) {
                        $menu .= '<li class="sidebar-item has-sub"><a href="' . $parent->pages . '" class="sidebar-link"><i class="' . $parent->icon . '"></i><span>' . $parent->nama . '</span></a><ul class="submenu">';
                    } else {
                        $menu .= '<li class="sidebar-item has-sub"><a href="/maintenance" class="sidebar-link"><i class="' . $parent->icon . '"></i><span>' . $parent->nama . '</span></a><ul class="submenu">';
                    }

                    foreach ($childs as $child) {
                        if ($parent->id == $child->parent) {
                            if ($child->status) {
                                $menu .= '<li class="submenu-item"><a href="' . $child->pages . '"><span>' . $child->nama . '</span></a></li>';
                            } else {
                                $menu .= '<li class="submenu-item"><a href="/maintenance"><span>' . $child->nama . '</span></a></li>';
                            }
                        }
                    }
                    $menu .= '</ul></li>';
                }
            }
            foreach ($childs as $child) {
                if ($title->id == $child->parent) {
                    if ($child->status) {
                        $menu .= '<li class="sidebar-item"><a href="' . $child->pages . '" class="sidebar-link"><i class="' . $child->icon . '"></i><span>' . $child->nama . '</span></a></li>';
                    } else {
                        $menu .= '<li class="sidebar-item"><a href="/maintenance" class="sidebar-link"><i class="' . $child->icon . '"></i><span>   ' . $child->nama . '</span></a></li>';
                    }
                }
            }
        }

        return $menu;
    }

    public function getFile($usr)
    {
        switch ($usr) {
            case "general":
                $file = "public/menu/menuGeneralUser.json";
                break;
            case "superadmin":
                $file = "public/menu/menuSuperadmin.json";
                break;
            default:
                $file = "public/menu/menuGeneralUser.json";
        }
        return $file;
    }

    protected $numberPage = 20;
}
