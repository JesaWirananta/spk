<?php

namespace App\Controllers;

use App\Models\CrispModel;

class Crisp extends BaseController
{
    public function index()
    {
        $data['title'] = 'Crisp';
        $data['q'] = $this->request->getGet('q');
        $crisp = new CrispModel();
        $data['rows'] = $crisp
            ->join('tb_kriteria', 'tb_kriteria.kode_kriteria=tb_crisp.kode_kriteria')
            ->like('kode_crisp', '' . $data['q'])
            ->orLike('nama_crisp', '' . $data['q'])
            ->orderBy('tb_crisp.kode_kriteria')
            ->orderBy('kode_crisp')
            ->findAll();
        load_view('crisp/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Crisp';
        load_view('crisp/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'kode_crisp' => [
                'rules' => 'required|is_unique[tb_crisp.kode_crisp]',
                'errors' => [
                    'required' => 'Id harus diisi',
                    'is_unique' => 'Id Crisp sudah ada',
                ],
            ],
            'kode_kriteria' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kriteria harus diisi',
                ],
            ],
            'nama_crisp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi',
                ],
            ],
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        } else {
            $crisp = new CrispModel();
            $kode_crisp = $this->request->getPost('kode_crisp');
            $crisp->insert([
                'kode_crisp' => $kode_crisp,
                'kode_kriteria' => $this->request->getPost('kode_kriteria'),
                'nama_crisp' => $this->request->getPost('nama_crisp'),
            ]);
            query("INSERT INTO tb_rel_crisp(ID1, ID2, nilai) SELECT '$kode_crisp', kode_crisp, 1 FROM tb_crisp");
            query("INSERT INTO tb_rel_crisp(ID1, ID2, nilai) SELECT kode_crisp, '$kode_crisp', 1 FROM tb_crisp WHERE kode_crisp<>'$kode_crisp'");
            return redirect()->to('/crisp')->with('msg', ['success', 'Data berhasil ditambah!']);
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Ubah Crisp';
        $crisp = new CrispModel();
        $data['row'] = $crisp->find($id);
        load_view('crisp/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama_crisp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi',
                ],
            ],
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        } else {
            $crisp = new CrispModel();
            $crisp->save([
                'kode_crisp' => $id,
                'nama_crisp' => $this->request->getPost('nama_crisp'),
            ]);
            return redirect()->to('/crisp')->with('msg', ['success', 'Data berhasil diubah!']);
        }
    }

    public function destroy($id)
    {
        $crisp = new CrispModel();
        query("DELETE FROM tb_rel_crisp WHERE ID1='$id' OR ID2='$id'");
        query("DELETE FROM tb_rel_alternatif WHERE kode_crisp='$id'");
        $crisp->delete($id);
        return redirect()->to('/crisp')->with('msg', ['success', 'Data berhasil dihapus!']);
    }
}
