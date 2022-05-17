<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class KategoriController extends ResourceController
{
    protected $modelName = 'App\Models\KategoriModel';

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
        $data['kategori'] = $this->model->findAll();

        $data['content'] = view('kategori/index', $data);
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

        $data['content'] = view('kategori/new', $data);
        $data['sidebar'] = view('cms/sidebar', $data);
        $data['footer'] = view('cms/footer', $data);;
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
            'nama'      => 'required|is_unique[kategori.nama]',
            'deskripsi' => 'max_length[100]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        } else {
            $field = [
                'nama'      => $this->request->getVar('nama', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'deskripsi' => $this->request->getVar('deskripsi', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ];

            // dd($field);
            $this->model->insert($field);
            return redirect()->to(base_url() . '/kategori')
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
        $data['kategori'] = $this->model->find($decId);

        $data['content'] = view('kategori/edit', $data);
        $data['sidebar'] = view('cms/sidebar', $data);
        $data['footer'] = view('cms/footer', $data);;
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
        $rules = [
            'nama'      => 'required|is_unique[kategori.nama,id,' . $decId . ']',
            'deskripsi' => 'max_length[100]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to(base_url() . '/kategori/edit/' . $id)
                ->withInput();
        } else {
            $field = [
                'nama'      => $this->request->getVar('nama', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'deskripsi' => $this->request->getVar('deskripsi', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ];

            // dd($field);
            $this->model->update($decId, $field);
            return redirect()->to(base_url() . '/kategori')
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
        $this->model->delete($decId);
        return redirect()->to(base_url() . '/kategori')
            ->with('successMessage',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-1" width="20" height="20" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill" /></svg>
                <strong>Berhasil!</strong> menghapus data
                <button type="button" class="btn-close p-1 mt-2 me-2" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
    }
}
