<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class StokController extends ResourceController
{
    protected $modelName = 'App\Models\StokModel';

    public function __construct()
    {
        $this->barang = model('App\Models\BarangModel');
        $this->supplier = model('App\Models\SupplierModel');
        session();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data['stok'] = $this->model->joins()->getResultArray();
        $data['supplier'] = $this->supplier->findAll();

        $data['content'] = view('stok/index', $data);
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
        $data['barang'] = $this->barang->findAll();
        $data['supplier'] = $this->supplier->findAll();

        $data['content'] = view('stok/new', $data);
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
            'id_barang'     => 'required|is_unique[stok.id_barang]',
            'id_supplier'   => 'required',
            'stok'          => 'required|integer',
            'satuan'        => 'required',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }else {
            $field = [
                'id_barang'       => $this->request->getVar('id_barang', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'id_supplier'     => substr(implode(',', $this->request->getVar('id_supplier', FILTER_SANITIZE_FULL_SPECIAL_CHARS)),1),
                'stok'            => $this->request->getVar('stok', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'satuan'          => $this->request->getVar('satuan', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ];
            // dd($field);
            $this->model->insert($field);
            return redirect()->to(base_url() . '/stok')
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
        $data['stok'] = $this->model->find($decId);
        $data['barang'] = $this->barang->findAll();
        $data['supplier'] = $this->supplier->findAll();

        $data['content'] = view('stok/edit', $data);
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
            'id_barang'     => 'required|is_unique[stok.id_barang,id,' . $decId . ']',
            'id_supplier'   => 'required',
            'stok'          => 'required|integer',
            'satuan'        => 'required',
        ];
        if (! $this->validate($rules)) {
            return redirect()->to(base_url().'/stok/edit/'. $id)
                ->withInput();
        }else {
            $field = [
                'id_barang'       => $this->request->getVar('id_barang', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'id_supplier'     => substr(implode(',', $this->request->getVar('id_supplier', FILTER_SANITIZE_FULL_SPECIAL_CHARS)), 1),
                'stok'            => $this->request->getVar('stok', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'satuan'          => $this->request->getVar('satuan', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ];

            // dd($field);
            $this->model->update($decId, $field);
            return redirect()->to(base_url() . '/stok')
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
        $file = "cms/img/stok/" . $user['file'];
        if (is_file($file)) unlink($file);
        $this->model->delete($decId);
        return redirect()->to(base_url() . '/stok')
            ->with('successMessage',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-1" width="20" height="20" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill" /></svg>
                <strong>Berhasil!</strong> menghapus data
                <button type="button" class="btn-close p-1 mt-2 me-2" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
    }

    public function deleteFile($id = null)
    {
        $decId = $this->model->decId($id);
        $user = $this->model->find($decId);
        $file = "cms/img/stok/" . $user['file'];
        if (is_file($file)) unlink($file);
        $this->model->update($decId, ['file'=>'']);
        return redirect()->to(base_url() . '/stok/edit/'. $id)
            ->with('successMessage',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-1" width="20" height="20" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill" /></svg>
                <strong>Berhasil!</strong> menghapus gambar
                <button type="button" class="btn-close p-1 mt-2 me-2" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
    }

}
