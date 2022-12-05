<?php

namespace App\Controllers;

class Rel_kriteria extends BaseController
{
    public function index()
    {
        $data['title'] = 'Bobot Kriteria';
        $data['rel_kriteria'] = get_rel_kriteria();
        $data['kriteria'] = get_kriteria();
        load_view('rel_kriteria/index', $data);
    }

    public function update()
    {
        $ID1 = $this->request->getPost('ID1');
        $ID2 = $this->request->getPost('ID2');
        $nilai = $this->request->getPost('nilai');
        if (!$this->validate([
            'ID1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kriteria 1 harus diisi',
                ],
            ],
            'nilai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nilai harus diisi',
                ],
            ],
            'ID2' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kriteria 2 harus diisi',
                ],
            ],
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        } elseif ($ID1 == $ID2 && $nilai != 1) {
            return redirect()->back()->withInput()->with('error', 'Kriteria yang sama harus bernilai 1');
        } else {
            query("UPDATE tb_rel_kriteria SET nilai='$nilai' WHERE ID1='$ID1' AND ID2='$ID2'");
            query("UPDATE tb_rel_kriteria SET nilai=1 / $nilai WHERE ID1='$ID2' AND ID2='$ID1'");
            return redirect()->to('/rel_kriteria')->with('msg', ['success', 'Data berhasil diubah!']);
        }
    }
}
