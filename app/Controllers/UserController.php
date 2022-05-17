<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    protected $modelName = 'App\Models\UserModel';

    public function __construct()
    {
        session();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data['users'] = $this->model->findAll();
        
        $data['content'] = view('users/index', $data);
        $data['sidebar'] = view('cms/sidebar', $data);
        $data['footer'] = view('cms/footer', $data);
        return view('cms/header', $data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        $data['val'] = service('validation');

        $data['content'] = view('users/new', $data);
        $data['sidebar'] = view('cms/sidebar', $data);
        $data['footer'] = view('cms/footer', $data);
        return view('cms/header', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $rules = [
            'nama'      => 'required',
            'email'     => 'required|valid_email|is_unique[users.email]',
            'password'  => 'required',
            'passconf'  => 'required|matches[password]',
            'foto'      => 'max_size[foto,1024]|is_image[foto]|ext_in[foto,png,jpg,jpeg]',
            'deskripsi' => 'max_length[100]',
            'alamat'    => 'required|max_length[100]',
            'telp'      => 'required|numeric|min_length[10]|max_length[15]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }else {
            if ($this->request->getFile('foto')!='') {
                $fileName = $this->request->getFile('foto')->getRandomName();
                $this->request->getFile('foto')->move('cms/img/users/' , $fileName);
            } else {
                $fileName = '';
            }
            $field = [
                'nama'      => $this->request->getVar('nama', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'email'     => $this->request->getVar('email', FILTER_SANITIZE_EMAIL),
                'password'  => $this->model->encPassword($this->request->getVar('password')),
                'foto'      => $fileName,
                'deskripsi' => $this->request->getVar('deskripsi', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'alamat'    => $this->request->getVar('alamat', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'telp'      => $this->request->getVar('telp', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ];
            $this->model->insert($field);
            return redirect()->to(base_url() . '/users')
                ->with('successMessage',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-1" width="20" height="20" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill" /></svg>
                    <strong>Berhasil!</strong> menambahkan data
                    <button type="button" class="btn-close p-1 mt-2 me-2" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $decId = $this->model->decId($id);
        $data['val'] = service('validation');
        $data['user'] = $this->model->find($decId);

        $data['content'] = view('users/edit', $data);
        $data['sidebar'] = view('cms/sidebar', $data);
        $data['footer'] = view('cms/footer', $data);
        return view('cms/header', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $decId = $this->model->decId($id);
        $user = $this->model->find($decId);
        if ($this->request->getVar('password')=='' && $this->request->getVar('passconf')=='') {
            $matches = 'string';
        } elseif ($this->request->getVar('password')=='' || $this->request->getVar('passconf')=='') {
            $matches = 'required|matches[password]';
        } elseif ($this->request->getVar('password')!='' && $this->request->getVar('passconf')!='') {
            $matches = 'required|matches[password]';
        }
        $rules = [
            'nama'      => 'required',
            'email'     => 'required|valid_email|is_unique[users.email,id,'. $decId.']',
            'passconf'  => $matches,
            'foto'      => 'max_size[foto,1024]|is_image[foto]|ext_in[foto,png,jpg,jpeg]',
            'deskripsi' => 'max_length[100]',
            'alamat'    => 'required|max_length[100]',
            'telp'      => 'required|integer|min_length[10]|max_length[15]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->to(base_url().'/users/edit/'. $id)
                ->withInput();
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
                'email'     => $this->request->getVar('email', FILTER_SANITIZE_EMAIL),
                'password'  => $this->request->getVar('password')!=''?$this->model->encPassword($this->request->getVar('password')):$user['password'],
                'foto'      => $fileName,
                'deskripsi' => $this->request->getVar('deskripsi', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'alamat'    => $this->request->getVar('alamat', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'telp'      => $this->request->getVar('telp', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ];

            // dd($field);
            $this->model->update($decId, $field);
            return redirect()->to(base_url() . '/users')
                ->with('successMessage',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-1" width="20" height="20" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill" /></svg>
                    <strong>Berhasil!</strong> update data
                    <button type="button" class="btn-close p-1 mt-2 me-2" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $decId = $this->model->decId($id);
        $user = $this->model->find($decId);
        $file = "cms/img/users/" . $user['foto'];
        if (is_file($file)) unlink($file);
        $this->model->delete($decId);
        return redirect()->to(base_url() . '/users')
                ->with('successMessage',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-1" width="20" height="20" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill" /></svg>
                    <strong>Berhasil!</strong> menghapus data
                    <button type="button" class="btn-close p-1 mt-2 me-2" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
    }

    public function deletePhoto($id = null)
    {
        $decId = $this->model->decId($id);
        $user = $this->model->find($decId);
        $file = "cms/img/users/" . $user['foto'];
        if (is_file($file)) unlink($file);
        $this->model->update($decId, ['foto'=>'']);
        return redirect()->to(base_url() . '/users/edit/'. $id)
                ->with('successMessage',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-1" width="20" height="20" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill" /></svg>
                    <strong>Berhasil!</strong> menghapus foto
                    <button type="button" class="btn-close p-1 mt-2 me-2" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
    }

}
