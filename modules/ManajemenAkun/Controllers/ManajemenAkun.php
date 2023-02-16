<?php

/* 
This is Controller ManajemenAkun
 */

namespace Modules\ManajemenAkun\Controllers;

use App\Controllers\BaseController;
use Modules\ManajemenAkun\Models\ManajemenAkunModel;
use App\Models\AuthGroupsModel;
use App\Models\AuthGroupsUsersModel;


class ManajemenAkun extends BaseController
{
    protected $manajemenAkunModel;
    protected $authGroupsUsersModel;
    protected $authGroupsModel;
    protected $validation;

    public function __construct()
    {
        $this->manajemenAkunModel = new ManajemenAkunModel();
        $this->authGroupsModel = new AuthGroupsModel();
        $this->authGroupsUsersModel = new AuthGroupsUsersModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_manajemenAkun') ? $this->request->getVar('page_manajemenAkun') : 1;
        $keyword = $this->request->getVar('keyword');
        $manajemenAkun = $this->manajemenAkunModel->getManajemenAkun($keyword);
        $data = [
            'menu' => $this->fetchMenu(),
            'title' => "Manajemen Akun",
            'breadcrumb' => ['User', 'Manajemen Akun'],
            'manajemenAkun' => $manajemenAkun->paginate($this->numberPage, 'manajemenAkun'),
            'authGroups' =>  $this->authGroupsModel->findAll(),
            'currentPage' => $currentPage,
            'numberPage' => $this->numberPage,
            'pager' => $manajemenAkun->pager,
            'validation' => \Config\Services::validation(),
        ];
        return view('Modules\ManajemenAkun\Views\manajemenAkun', $data);
    }

    public function edit($id)
    {
        $url = $this->request->getServer('HTTP_REFERER');
        $rules = [
            'userEmail' => rv('required', ['required' => 'Email harus diisi!']),
            'userName' => rv('required', ['required' => 'Username harus diisi!']),
            'userRole' => rv('required', ['required' => 'Role harus dipilih!']),
        ];
        if (!$this->validate($rules)) {
            return redirect()->to($url)->withInput();
        };

        $data = [
            'email' => trim($this->request->getVar('userEmail')),
            'username' => trim($this->request->getVar('userName')),
            'active' => trim($this->request->getVar('userActive')) == null ? 0 : 1,
        ];
        $data_user_group = ['group_id' => trim($this->request->getVar('userRole'))];
        // dd($data, $data_user_group);

        if ($this->manajemenAkunModel->update($id, $data)) {
            if ($this->authGroupsUsersModel->update($id, $data_user_group)) {
                session()->setFlashdata('success', 'Data akun berhasil diupdate!');
                return redirect()->to($url);
            }
        }
    }
}
