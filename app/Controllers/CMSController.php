<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CMSController extends BaseController
{
    public function __construct()
    {
        session();
        $this->model = model('App\Models\UserModel');
        $this->supplier = model('App\Models\SupplierModel');
        $this->barang = model('App\Models\BarangModel');
        $this->stok = model('App\Models\StokModel');
    }
    
    public function home()
    {
        $data['pieChart_stok'] = $this->stok->chartData()->getResultArray();

        $data['content'] = view('cms/index', $data);
        $data['sidebar'] = view('cms/sidebar', $data);
        $data['footer'] = view('cms/footer', $data);
        return view('cms/header', $data);
    }

    public function profile($id = null)
    {
        $decId = $this->model->decId($id);
        $data['val'] = service('validation');
        $data['user'] = $this->model->find($decId);
        
        $data['content'] = view('users/profile', $data);
        $data['sidebar'] = view('cms/sidebar', $data);
        $data['footer'] = view('cms/footer', $data);
        return view('cms/header', $data);
    }
    
    public function updateProfile($id = null)
    {
        $decId = $this->model->decId($id);
        $user = $this->model->find($decId);
        if ($this->request->getVar('oldpass')!='' && $this->request->getVar('password')!='' && $this->request->getVar('passconf')!='') {
            if (($user['password'] == $this->model->encPassword($this->request->getVar('oldpass'))) && ($this->request->getVar('password') == $this->request->getVar('passconf'))) {
                $matches = 'string';
            } else {
                return redirect()->to(base_url() . '/user/profile/'.$id)
                    ->with('messageFailed', '<span class="text-danger" role="alert">Password doesn\'t match!</span>');
            }
        } elseif(!empty($this->request->getVar('oldpass') || $this->request->getVar('password') || $this->request->getVar('passconf'))) {
            return redirect()->to(base_url() . '/user/profile/'.$id)
                ->with('messageFailed', '<span class="text-danger" role="alert">Password doesn\'t match!</span>');
        } else {
            $matches = 'string';
        }
        $rules = [
            'nama'      => 'required',
            'passconf'  => $matches,
            'foto'      => 'max_size[foto,1024]|is_image[foto]|ext_in[foto,png,jpg,jpeg]',
            'deskripsi' => 'max_length[100]',
            'alamat'    => 'required|max_length[100]',
            'telp'      => 'required|integer|min_length[10]|max_length[15]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }else {
            if ($this->request->getFile('foto')!='') {
                $fileName = $this->request->getFile('foto')->getRandomName();
                $this->request->getFile('foto')->move('cms/img/users/' , $fileName);
                $file = "cms/img/users/" . $user['foto'];
                if (is_file($file)) unlink($file);
            } else {
                $fileName = $user['foto'];
            }
            $field = [
                'nama'      => $this->request->getVar('nama', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'password'  => $this->request->getVar('password')!=''?$this->model->encPassword($this->request->getVar('password')):$user['password'],
                'foto'      => $fileName,
                'deskripsi' => $this->request->getVar('deskripsi', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'alamat'    => $this->request->getVar('alamat', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'telp'      => $this->request->getVar('telp', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ];

            // dd($field);
            $this->model->update($decId, $field);
            return redirect()->to(base_url() . '/user/profile/'.$id)
                ->with('successMessage',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-1" width="20" height="20" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill" /></svg>
                    <strong>Berhasil!</strong> update profil
                    <button type="button" class="btn-close p-1 mt-2 me-2" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
        }
    }

    public function deletePhoto($id = null)
    {
        $decId = $this->model->decId($id);
        $user = $this->model->find($decId);
        $file = "cms/img/users/" . $user['foto'];
        if (is_file($file)) unlink($file);
        $this->model->update($decId, ['foto'=>'']);
        return redirect()->to(base_url() . '/user/profile/'.$id)
            ->with('successMessage',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-1" width="20" height="20" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill" /></svg>
                <strong>Berhasil!</strong> menghapus foto profil
                <button type="button" class="btn-close p-1 mt-2 me-2" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
    }
}
