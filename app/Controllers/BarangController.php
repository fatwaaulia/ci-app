<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class BarangController extends ResourceController
{
    protected $modelName = 'App\Models\BarangModel';

    public function __construct()
    {
        $this->kategori = model('App\Models\KategoriModel');
        session();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data['barang'] = $this->model->joinKategori()->getResultArray();

        $data['content'] = view('barang/index', $data);
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
        // $data['barang'] = $this->barang->findAll();
        $data['kategori'] = $this->kategori->findAll();

        $data['content'] = view('barang/new', $data);
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
        for (;;) {
            $char = '1234567890';
            $random = substr(str_shuffle($char), 0, 6);
            $cek = $this->model->getWhere(['kode' => 'S-' . $random])->getNumRows();
            if ($cek == 0) {
                break;
            }
        }
        $rules = [
            'kode'          => 'is_unique[barang.kode]',
            'id_kategori'   => 'required',
            'nama'          => 'required|is_unique[barang.nama]',
            'file'          => 'max_size[file,1024]|is_image[file]|ext_in[file,png,jpg,jpeg]',
            'harga_beli'    => 'required|integer',
            'harga_jual'    => 'required|integer',
            'deskripsi'     => 'max_length[3000]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }else {
            if ($this->request->getFile('file')!='') {
                $fileName = $this->request->getFile('file')->getRandomName();
                $this->request->getFile('file')->move('cms/img/barang/' , $fileName);
            } else {
                $fileName = '';
            }
            $field = [
                'kode'          => 'B' . $random,
                'id_kategori'   => $this->request->getVar('id_kategori', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'nama'          => $this->request->getVar('nama', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'file'          => $fileName,
                'harga_beli'    => $this->request->getVar('harga_beli', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'harga_jual'    => $this->request->getVar('harga_jual', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'deskripsi'     => $this->request->getVar('deskripsi', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ];
            // dd($field);
            $this->model->insert($field);
            return redirect()->to(base_url() . '/barang')
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
        // echo $decId;
        // die;
        $data['val'] = service('validation');
        $data['barang'] = $this->model->find($decId);
        $data['kategori'] = $this->kategori->findAll();

        $data['content'] = view('barang/edit', $data);
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
        $user = $this->model->find($decId);
        $rules = [
            'id_kategori'   => 'required',
            'nama'          => 'required|is_unique[barang.nama,id,' . $decId . ']',
            'file'          => 'max_size[file,1024]|is_image[file]|ext_in[file,png,jpg,jpeg]',
            'harga_beli'    => 'required|integer',
            'harga_jual'    => 'required|integer',
            'deskripsi'     => 'max_length[3000]',
            
        ];
        if (! $this->validate($rules)) {
            return redirect()->to(base_url().'/barang/edit/'. $id)
                ->withInput();
        }else {
            if ($this->request->getFile('file')!='') {
                $fileName = $this->request->getFile('file')->getRandomName();
                $this->request->getFile('file')->move('cms/img/barang/' , $fileName);
                $file = "cms/img/barang/" . $user['file'];
                if (is_file($file)) unlink($file);
            } else {
                $fileName = $user['file'];
            }
            $field = [
                // 'kode'          => $this->request->getVar('kode'),
                'id_kategori'   => $this->request->getVar('id_kategori', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'nama'          => $this->request->getVar('nama', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'file'          => $fileName,
                'harga_beli'    => $this->request->getVar('harga_beli', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'harga_jual'    => $this->request->getVar('harga_jual', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'deskripsi' => $this->request->getVar('deskripsi', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ];

            // dd($field);
            $this->model->update($decId, $field);
            return redirect()->to(base_url() . '/barang')
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
        $file = "cms/img/barang/" . $user['file'];
        if (is_file($file)) unlink($file);
        $this->model->delete($decId);
        return redirect()->to(base_url() . '/barang')
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
        $file = "cms/img/barang/" . $user['file'];
        if (is_file($file)) unlink($file);
        $this->model->update($decId, ['file'=>'']);
        return redirect()->to(base_url() . '/barang/edit/'. $id)
            ->with('successMessage',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-1" width="20" height="20" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill" /></svg>
                <strong>Berhasil!</strong> menghapus gambar
                <button type="button" class="btn-close p-1 mt-2 me-2" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
    }

}
