<?php

namespace App\Controllers;

use AHP;
use App\Models\AlternatifModel;

class Hitung extends BaseController
{
    public function index()
    {
        $data['title'] = 'Perhitungan';
        $data['rel_kriteria'] = get_rel_kriteria();
        $data['ahp'] = new AHP($data['rel_kriteria']);
        $data['kriterias'] = get_kriteria();
        $data['alternatifs'] = get_alternatif();
        $data['rel_alternatif'] = get_rel_alternatif();
        $data['crisps'] = get_crisp();
        $data['akhir'] = $this->get_akhir($data['rel_alternatif'], $data['crisps'], $data['ahp']->prioritas);
        foreach ($data['akhir'] as $key => $val) {
            $alternatif = new AlternatifModel();
            $alternatif->save([
                'kode_alternatif' => $key,
                'total' => $val,
            ]);
        }
        load_view('hitung/index', $data);
    }
    private function get_akhir($analisa, $CRISP, $rata)
    {
        $arr = array();
        foreach ($analisa as $key => $val) {
            foreach ($val as $k => $v) {
                $arr[$key][$k] = $CRISP[$v]->nilai_crisp * $rata[$k];
            }
        }
        $total = array();
        foreach ($arr as $key => $val) {
            $total[$key] = array_sum($val);
        }
        return $total;
    }

    public function cetak()
    {
        $data['title'] = 'Hasil Perhitungan';
        $data['kriteria'] = get_kriteria();
        $data['alternatifs'] = get_results("SELECT * FROM tb_alternatif ORDER BY total");
        return view('hitung/cetak', $data);
    }
}
