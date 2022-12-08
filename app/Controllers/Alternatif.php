<?php

namespace App\Controllers;

use App\Models\AlternatifModel;
use App\Models\RelasiModel;

class Alternatif extends BaseController
{
    public function index()
    {
        $data['title'] = 'Alternatif';
        $data['q'] = $this->request->getGet('q');
        $alternatif = new AlternatifModel();
        $data['rows'] = $alternatif->like('nim', $data['q'])->orLike('nama_alternatif', $data['q'])->findAll();
        $data['kriteria'] = get_kriteria();
        $data['rel_alternatif'] = get_rel_alternatif();
        $data['crisp'] = get_crisp();
        load_view('alternatif/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Alternatif';
        $data['KRITERIA'] = get_kriteria();
        load_view('alternatif/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'kode_alternatif' => [
                'rules' => 'required|is_unique[tb_alternatif.kode_alternatif]',
                'errors' => [
                    'required' => 'Id harus diisi',
                    'is_unique' => 'Id Alternatif sudah ada',
                ],
            ],
            'nama_alternatif' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi',
                ],
            ],


            'nim' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nim harus diisi',
                ],
            ],

            'fakultas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Fakultas harus diisi',
                ],
            ],

            'nilai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Semua nilai harus diisi',
                ],
            ],
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        } else {
            $alternatif = new AlternatifModel();
            $alternatif->insert([
                'kode_alternatif' => $this->request->getPost('kode_alternatif'),
                'nama_alternatif' => $this->request->getPost('nama_alternatif'),
                'nim' => $this->request->getPost('nim'),
                'fakultas' => $this->request->getPost('fakultas')
            ]);
            foreach ($this->request->getPost('nilai') as $key => $val) {
                $rel_alternatif = new RelasiModel();
                $rel_alternatif->insert([
                    'kode_alternatif' => $this->request->getPost('kode_alternatif'),
                    'kode_kriteria' => $key,
                    'kode_crisp' => $val,
                ]);
            }
            return redirect()->to('/alternatif')->with('msg', ['success', 'Data berhasil ditambah!']);
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Ubah Alternatif';
        $alternatif = new AlternatifModel();
        $data['kriterias'] = get_kriteria();
        $data['row'] = $alternatif->find($id);
        $data['crisps'] = get_crisp();
        $data['nilais'] = get_results("SELECT * FROM tb_rel_alternatif WHERE kode_alternatif='$id' ORDER BY kode_kriteria");
        load_view('alternatif/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama_alternatif' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi',
                ],
            ],

            'nim' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Semua nilai harus diisi',
                ],
            ],

            'fakultas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Semua nilai harus diisi',
                ],
            ],

            'nilai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Semua nilai harus diisi',
                ],
            ],
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        } else {
            $alternatif = new AlternatifModel();
            $alternatif->save([
                'kode_alternatif' => $id,
                'nama_alternatif' => $this->request->getPost('nama_alternatif'),
                'nim' => $this->request->getPost('nim'),
                'fakultas' => $this->request->getPost('fakultas')
            ]);
            foreach ($this->request->getPost('nilai') as $key => $val) {
                $rel_alternatif = new RelasiModel();
                $rel_alternatif->update($key, [
                    'kode_crisp' => $val,
                ]);
            }
            return redirect()->to('/alternatif')->with('msg', ['success', 'Data berhasil diubah!']);
        }
    }

    public function destroy($id)
    {
        $alternatif = new AlternatifModel();
        query("DELETE FROM tb_rel_alternatif WHERE kode_alternatif='$id'");
        $alternatif->delete($id);
        return redirect()->to('/alternatif')->with('msg', ['success', 'Data berhasil dihapus!']);
    }
}
