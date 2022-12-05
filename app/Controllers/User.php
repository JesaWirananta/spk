<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function logout()
    {
        session()->destroy();
        return redirect()->to('home');
    }
    public function login()
    {
        $data['title'] = 'Password';
        return view('user/login', $data);
    }

    public function login_action()
    {
        $users = new UserModel();
        $user = $users->where('user', $this->request->getPost('user'))->first();
        if ($user) {
            if (password_verify($this->request->getPost('pass'), $user->pass)) {
                session()->set([
                    'ID' => $user->id_user,
                    'user' => $user->user,
                    'logged_in' => true,
                ]);
                return redirect()->to('home');
            } else {
                session()->setFlashdata('error', 'Salah kombinasi username dan password!');
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata('error', 'Username tidak ditemukan!');
            return redirect()->back();
        }
    }


    public function password()
    {
        $data['title'] = 'Password';
        $data['row'] = session()->get('user');
        load_view('user/password', $data);
    }

    public function password_update()
    {
        if (!$this->validate([
            'pass1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password lama harus diisi',
                ],
            ],
            'pass2' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password baru harus diisi',
                ],
            ],
            'pass3' => [
                'rules' => 'required|matches[pass2]',
                'errors' => [
                    'required' => 'Konfirmasi password baru harus diisi',
                    'matches' => 'Password baru dan Konfirmasi password baru harus sama',
                ],
            ],
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        } else {
            $users = new UserModel();
            $user = $users->find(session()->get('ID'));
            if (!password_verify($this->request->getPost('pass1'), $user->pass)) {
                session()->setFlashdata('error', 'Password lama salah!');
                return redirect()->back()->withInput();
            } else {
                $users->update(session()->get('ID'), ['pass' => password_hash($this->request->getPost('pass2'), PASSWORD_BCRYPT)]);


                $user = $users->find(session()->get('ID'));
                session()->set('user', $user);
                return redirect()->back()->with('msg', ['success', 'Password berhasil diubah!']);
            }
            // return redirect()->to('/user')->with('msg', ['success', 'Data berhasil diubah!']);
        }
    }

    public function index()
    {
        $data['title'] = 'User';
        $data['q'] = $this->request->getGet('q');
        $user = new UserModel();
        $data['rows'] = $user->like('id_user', (string) $data['q'])->orLike('nama_user', '' . $data['q'])->findAll();
        load_view('user/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Register';
        load_view('user/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'id_user' => [
                'rules' => 'required|is_unique[tb_user.id_user]',
                'errors' => [
                    'required' => 'Id harus diisi',
                    'is_unique' => 'Id User sudah ada',
                ],
            ],
            'nama_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi',
                ],
            ],
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        } else {
            $user = new UserModel();
            $user->insert([
                'id_user' => $this->request->getPost('id_user'),
                'nama_user' => $this->request->getPost('nama_user'),
            ]);
            $id_user = $this->request->getPost('id_user');
            query("INSERT INTO tb_rel_alternatif (kode_alternatif, id_user) SELECT kode_alternatif, '$id_user' FROM tb_alternatif");



            return redirect()->to('/user')->with('msg', ['success', 'Data berhasil ditambah!']);
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Ubah User';
        $user = new UserModel();
        $data['row'] = $user->find($id);
        load_view('user/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi',
                ],
            ],
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        } else {
            $user = new UserModel();
            $user->save([
                'id_user' => $id,
                'nama_user' => $this->request->getPost('nama_user'),
            ]);
            return redirect()->to('/user')->with('msg', ['success', 'Data berhasil diubah!']);
        }
    }

    public function destroy($id)
    {
        $user = new UserModel();
        query("DELETE FROM tb_rel_alternatif WHERE id_user='$id'");
        $user->delete($id);
        return redirect()->to('/user')->with('msg', ['success', 'Data berhasil dihapus!']);
    }
}
