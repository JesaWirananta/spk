<?php
class SingleExponentialSmoothing
{
    public $yt;
    public $alpha_yt;
    public $alternatif;
    public $alpha;
    public $ft;
    public $err;
    public $x_kuadrat;
    public $max_alternatif;

    function __construct($yt, $alternatif, $alpha)
    {
        $this->yt = $yt;
        $this->alternatif = $alternatif;
        $this->alpha = $alpha;
        $this->hitung();
        $this->error();
    }

    function error()
    {
        $a = 1;
        foreach ($this->ft as $key => $val) {
            if ($a > $this->alpha) {
                $this->err[$key] = $this->ft[$key] - $this->yt[$key];
                $this->err_square[$key] = $this->err[$key] * $this->err[$key];
                $this->err_abs[$key] = abs($this->err[$key]);
                $this->err_yt[$key] = abs($this->err[$key] / $this->yt[$key]);
                //echo "{$this->err[$key]} / $val <br />";
            }
            $a++;
        }
        $this->errs['MSE'] = array_sum($this->err_square) / count($this->err_square);
        $this->errs['RMSE'] = sqrt($this->errs['MSE']);
        $this->errs['MAD'] = array_sum($this->err_abs) / count($this->err_abs);
        $this->errs['MAPE'] = array_sum($this->err_yt) / count($this->err_yt);
        //echo ' <pre>' . print_r($this->errs, 1) . '</pre>';
    }

    function hitung()
    {
        $prev = array();

        $no = 1;
        $temp_yt = 0;
        $temp_alpha_yt = 0;
        $temp_ft = 0;

        foreach ($this->yt as $key => $val) {
            if ($no > 1)
                $this->alpha_yt[$key] = $this->alpha * $this->yt[$key];

            if ($no > 1)
                $this->ft[$key] = $temp_yt;
            if ($no > 2) {
                $this->ft[$key] = $temp_alpha_yt + (1 - $this->alpha) * $temp_ft;
            }

            if (isset($this->alpha_yt[$key]))
                $temp_alpha_yt = $this->alpha_yt[$key];
            $temp_yt = $this->yt[$key];

            if (isset($this->ft[$key]))
                $temp_ft = $this->ft[$key];
            $no++;
        }

        $this->max_alternatif = max(array_keys($this->yt));

        for ($a = 1; $a <= $this->alternatif; $a++) {
            $key = date('Y-m-d', strtotime("+$a month", strtotime($this->max_alternatif)));
            $this->next_ft[$key] = $temp_alpha_yt + (1 - $this->alpha) * $temp_ft;
            //$temp_alpha_yt = $temp_ft * $this->alpha;
            $temp_ft = $this->next_ft[$key];
        }

        // echo ' <pre>' . print_r($this->alternatif, 1) . '</pre>';
    }
}
function get_nilai_option($selected = '')
{
    $nilai = array(
        '1' => 'Sama penting dengan',
        '2' => 'Mendekati sedikit lebih penting dari',
        '3' => 'Sedikit lebih penting dari',
        '4' => 'Mendekati lebih penting dari',
        '5' => 'Lebih penting dari',
        '6' => 'Mendekati sangat penting dari',
        '7' => 'Sangat penting dari',
        '8' => 'Mendekati mutlak dari',
        '9' => 'Mutlak sangat penting dari',
    );
    $a = '';
    foreach ($nilai as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$key - $value</option>";
        else
            $a .= "<option value='$key'>$key - $value</option>";
    }
    return $a;
}

function get_kriteria_option($selected = '')
{
    $rows = get_results("SELECT * FROM tb_kriteria ORDER BY kode_kriteria");
    $a = '';
    foreach ($rows as $row) {
        if ($selected == $row->kode_kriteria)
            $a .= "<option value='$row->kode_kriteria' selected>[$row->kode_kriteria] $row->nama_kriteria</option>";
        else
            $a .= "<option value='$row->kode_kriteria'>[$row->kode_kriteria] $row->nama_kriteria</option>";
    }
    return $a;
}
function get_crisp_option($selected = '', $kode_kriteria = '')
{
    $crisp = get_crisp();
    $a = '';
    foreach ($crisp as $row) {
        if ($row->kode_kriteria == $kode_kriteria) {
            if ($selected == $row->kode_crisp)
                $a .= "<option value='$row->kode_crisp' selected>$row->nama_crisp</option>";
            else
                $a .= "<option value='$row->kode_crisp'>$row->nama_crisp</option>";
        }
    }
    return $a;
}

function get_data()
{
    $rows = get_results("SELECT kode_kriteria, nama_alternatif, sum(nilai) AS nilai FROM tb_rel_alternatif r INNER JOIN tb_alternatif p ON p.kode_alternatif=r.kode_alternatif GROUP BY kode_kriteria, YEAR(nama_alternatif), MONTH(nama_alternatif) ORDER BY kode_kriteria, p.kode_alternatif");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_kriteria][$row->nama_alternatif] = $row->nilai;
    }
    return $arr;
}


function load_view($name, $data = [], $options = [])
{
    echo view('app/header.php', $data, $options);
    echo view($name, $data, $options);
    echo view('app/footer.php', $data, $options);
}

function print_error()
{
    $error = session()->getFlashdata('error');
    if ($error) {
        echo '<div class="alert alert-danger" alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $error . '</div>';
    }
}

function show_msg()
{
    $msg = session()->get('msg');
    if ($msg)
        echo '<div class="alert alert-' . $msg[0] . '" alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $msg[1] . '</div>';
}

function kode_oto($field, $table, $prefix, $length)
{
    $row = get_row("SELECT $field AS kode FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");

    if ($row) {
        return $prefix . substr(str_repeat('0', $length) . (substr($row->kode, -$length) + 1), -$length);
    } else {
        return $prefix . str_repeat('0', $length - 1) . 1;
    }
}

function get_row($sql)
{
    $query = query($sql);
    return $query->getRow();
}

function get_results($sql)
{
    $query = query($sql);
    return $query->getResult();
}

function get_var($sql)
{
    $query = query($sql);
    $row = $query->getRowArray();
    if ($row)
        return current($row);
}

function query($sql)
{
    $db = db_connect();
    return $db->query($sql);
}

function get_kriteria()
{
    $rows = get_results("SELECT * FROM tb_kriteria ORDER BY kode_kriteria");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_kriteria] = $row;
    }
    return $arr;
}
function get_alternatif()
{
    $rows = get_results("SELECT * FROM tb_alternatif ORDER BY kode_alternatif");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_alternatif] = $row;
    }
    return $arr;
}

function get_rel_alternatif()
{
    $rows = get_results("SELECT * FROM tb_rel_alternatif ORDER BY kode_kriteria, kode_alternatif");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_alternatif][$row->kode_kriteria] = $row->kode_crisp;
    }
    return $arr;
}

function get_crisp()
{
    $rows = get_results("SELECT * FROM tb_crisp");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_crisp] = $row;
    }
    return $arr;
}

function get_rel_crisp($kode_kriteria)
{
    $rows = get_results("SELECT * FROM tb_rel_crisp WHERE ID1 IN (SELECT kode_crisp FROM tb_crisp WHERE kode_kriteria='$kode_kriteria') AND ID2 IN (SELECT kode_crisp FROM tb_crisp WHERE kode_kriteria='$kode_kriteria') ORDER BY ID1, ID2");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->ID1][$row->ID2] = $row->nilai;
    }
    return $arr;
}
function get_rel_kriteria()
{
    $rows = get_results("SELECT * FROM tb_rel_kriteria ORDER BY ID1, ID2");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->ID1][$row->ID2] = $row->nilai;
    }
    return $arr;
}

class AHP
{
    public $matrix;
    public $baris_total;
    public $normal;
    public $prioritas;
    public $cm;
    public $CI;
    public $RI;
    public $CR;
    public $konsistensi;

    function __construct($matrix)
    {
        $this->matrix = $matrix;
        $this->baris_total();
        $this->normal();
        $this->prioritas();
        $this->cm();
        $this->konsistensi();
    }

    function konsistensi()
    {
        $nRI = array(
            1 => 0,
            2 => 0,
            3 => 0.58,
            4 => 0.9,
            5 => 1.12,
            6 => 1.24,
            7 => 1.32,
            8 => 1.41,
            9 => 1.46,
            10 => 1.49,
            11 => 1.51,
            12 => 1.48,
            13 => 1.56,
            14 => 1.57,
            15 => 1.59
        );
        $cm = $this->cm;
        $this->CI = count($cm) > 1 ? ((array_sum($cm) / count($cm)) - count($cm)) / (count($cm) - 1) : 0;
        $this->RI = count($cm) > 0 ? $nRI[count($cm)] : 0;
        $this->CR = $this->RI == 0 ? 0 : $this->CI / $this->RI;
        $this->konsistensi = $this->CR <= 0.1 ? 'Konsisten' : 'Tidak Konsisten';
    }

    function cm()
    {
        $this->cm = array();
        foreach ($this->matrix as $key => $val) {
            $this->cm[$key] = 0;
            foreach ($val as $k => $v) {
                $this->cm[$key] += $v * $this->prioritas[$k];
            }
            $this->cm[$key] /= $this->prioritas[$key];
        }
    }

    function prioritas()
    {
        $this->prioritas = array();
        foreach ($this->normal as $key => $val) {
            $this->prioritas[$key] = array_sum($val) / count($val);
        }
    }

    function normal()
    {
        $this->normal = array();
        foreach ($this->matrix as $key => $val) {
            foreach ($val as $k => $v) {
                $this->normal[$key][$k] = $v / $this->baris_total[$k];
            }
        }
    }

    function baris_total()
    {
        $this->baris_total = array();
        foreach ($this->matrix as $key => $val) {
            foreach ($val as $k => $v) {
                if (!isset($this->baris_total[$k]))
                    $this->baris_total[$k] = 0;
                $this->baris_total[$k] += $v;
            }
        }
    }

    function total()
    {
        foreach ($this->normal as $key => $val) {
            foreach ($val as $k => $v) {
                $this->total[$key] += $v * $this->prioritas[$k];
            }
        }
    }
}
