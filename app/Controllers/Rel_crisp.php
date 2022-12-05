<?php

namespace App\Controllers;

use AHP;
use App\Models\CrispModel;

class Rel_crisp extends BaseController
{
    public function index()
    {
        $data['title'] = 'Bobot Crisp';
        $data['crisp'] = get_crisp();
        $data['kode_kriteria'] = $this->request->getGet('kode_kriteria');
        $data['rel_crisp'] = get_rel_crisp($data['kode_kriteria']);
        $data['ahp'] = new AHP($data['rel_crisp']);
        foreach ($data['ahp']->prioritas as $key => $val) {
            $crisp = new CrispModel();
            $crisp->save([
                'kode_crisp' => $key,
                'nilai_crisp' => $val,
            ]);
        }
        load_view('rel_crisp/index', $data);
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
                    'required' => 'Crisp 1 harus diisi',
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
                    'required' => 'Crisp 2 harus diisi',
                ],
            ],
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        } elseif ($ID1 == $ID2 && $nilai != 1) {
            return redirect()->back()->withInput()->with('error', 'Kriteria yang sama harus bernilai 1');
        } else {
            query("UPDATE tb_rel_crisp SET nilai='$nilai' WHERE ID1='$ID1' AND ID2='$ID2'");
            query("UPDATE tb_rel_crisp SET nilai=1 / $nilai WHERE ID1='$ID2' AND ID2='$ID1'");
            return redirect()->to('/rel_crisp?kode_kriteria=' . $this->request->getGet('kode_kriteria'))->with('msg', ['success', 'Data berhasil diubah!']);
        }
    }
}
