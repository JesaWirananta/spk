<?php

namespace App\Controllers;

use App\Models\KriteriaModel;

class Kriteria extends BaseController
{
    public function index()
    {
        $data['title'] = 'Kriteria';
        $data['q'] = $this->request->getGet('q');
        $kriteria = new KriteriaModel();
        $data['rows'] = $kriteria->like('kode_kriteria', (string) $data['q'])
            ->orLike('nama_kriteria', '' . $data['q'])
            ->orderBy('kode_kriteria')
            ->findAll();
        load_view('kriteria/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Kriteria';
        load_view('kriteria/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'kode_kriteria' => [
                'rules' => 'required|is_unique[tb_kriteria.kode_kriteria]',
                'errors' => [
                    'required' => 'Id harus diisi',
                    'is_unique' => 'Id Kriteria sudah ada',
                ],
            ],
            'nama_kriteria' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi',
                ],
            ],
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        } else {
            $kriteria = new KriteriaModel();
            $kode_kriteria = $this->request->getPost('kode_kriteria');
            $kriteria->insert([
                'kode_kriteria' => $kode_kriteria,
                'nama_kriteria' => $this->request->getPost('nama_kriteria'),
            ]);
            query("INSERT INTO tb_rel_kriteria(ID1, ID2, nilai) SELECT '$kode_kriteria', kode_kriteria, 1 FROM tb_kriteria");
            query("INSERT INTO tb_rel_kriteria(ID1, ID2, nilai) SELECT kode_kriteria, '$kode_kriteria', 1 FROM tb_kriteria WHERE kode_kriteria<>'$kode_kriteria'");
            query("INSERT INTO tb_rel_alternatif (kode_alternatif, kode_kriteria, kode_crisp) SELECT kode_alternatif, '$kode_kriteria', '' FROM tb_alternatif");
            return redirect()->to('/kriteria')->with('msg', ['success', 'Data berhasil ditambah!']);
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Ubah Kriteria';
        $kriteria = new KriteriaModel();
        $data['row'] = $kriteria->find($id);
        load_view('kriteria/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama_kriteria' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi',
                ],
            ],
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        } else {
            $kriteria = new KriteriaModel();
            $kriteria->save([
                'kode_kriteria' => $id,
                'nama_kriteria' => $this->request->getPost('nama_kriteria'),
            ]);
            return redirect()->to('/kriteria')->with('msg', ['success', 'Data berhasil diubah!']);
        }
    }

    public function destroy($id)
    {
        $kriteria = new KriteriaModel();
        query("DELETE FROM tb_rel_kriteria WHERE ID1='$id' OR ID2='$id'");
        query("DELETE FROM tb_rel_alternatif WHERE kode_kriteria='$id'");
        $kriteria->delete($id);
        return redirect()->to('/kriteria')->with('msg', ['success', 'Data berhasil dihapus!']);
    }
}
