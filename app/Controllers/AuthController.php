<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function __construct()
    {
        $this->model = model('App\Models\UserModel');
        // session();
    }

    public function login()
    {
        if (session()->isLogin) return redirect()->to(base_url() . '/dashboard');
        $data['val'] = service('validation');

        $data['content'] = view('auth/login', $data);
        $data['sidebar'] = null;
        $data['footer'] = null;
        return view('cms/header', $data);
        
    }

    public function loginProccess()
    {
        $rules = [
            'email'     => 'required|valid_email',
            'password'  => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to(base_url().'/login/auth')
            ->withInput();
        } else {
            $data = [
                'email' => $this->request->getVar('email'),
                'password' => model('userModel')->encPassword($this->request->getVar('password')),
            ];
            $cek = $this->model->getWhere($data)->getNumRows();
            if ($cek > 0) {
                $session = [
                    'isLogin' => true,
                    'user'    => $this->model->where($data)->find(),
                ];
                session()->set($session);
                return redirect()->to(base_url() . '/dashboard');
            } else {
                return redirect()->to(base_url() . '/login/auth')
                ->with('msgLogin', '<p class="alert alert-danger p-1 mb-2" role="alert">Email or Password not found!</p>');
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url() . '/login/auth');
    }

    public function forgotPassword()
    {
        if (session()->isLogin) return redirect()->to(base_url() . '/dashboard');
        $data['val'] = service('validation');
        
        $data['content'] = view('auth/forgotPassword', $data);
        $data['sidebar'] = null;
        $data['footer'] = null;
        return view('cms/header', $data);
    }

    public function passwordResetVal()
    {
        if (!$this->validate(['email'=>'required|valid_email'])) {
            return redirect()->to(base_url().'/forgot-password/auth')
            ->withInput();
        } else {
            $data = [
                'email' => $this->request->getVar('email')
            ];
            $cek = $this->model->getWhere($data)->getNumRows();
            $user = $this->model->where($data)->first();
            if ($cek > 0) {
                $getToken = substr(md5(mt_rand()), 0, 32);
                $this->model->update($user['id'], ['token'=>$getToken]);
                // die;
                $to      = $user['email'];
                $subject = 'Permintaan reset password';
                $message = "Hi, $user[nama] <br><br>"
                            . 'Permintaan reset password kamu telah diterima. <br>'
                            . 'Silahkan klik tautan di bawah ini untuk mengatur ulang kata sandi.<br><br>'
                            . '<a href="'.base_url(). '/reset-password/auth/'. $getToken. '">Klik</a> <br><br>'
                            . 'Thank You' ;
                // echo $message;
                // die;

                $email = service('email');
                $email->setFrom('fatwaaulia.fy@gmail.com', 'Fatwa Aulia');
                $email->setTo('fatwaaulia.fy@gmail.com');
                $email->setSubject($subject);
                $email->setMessage($message);

                if ($email->send()) {
                    return redirect()->to(base_url() . '/forgot-password/auth')
                        ->with('msgForgotPassword', '<p class="alert alert-success p-1 mb-2" role="alert">Cek email untuk reset password</p>');
                } else {
                    // $data = $email->printDebugger(['headers']);
                    // print_r($data);
                    return redirect()->to(base_url() . '/forgot-password/auth')
                        ->with('msgForgotPassword', '<p class="alert alert-danger p-1 mb-2" role="alert">ERROR!</p>');
                }
            } else {
                return redirect()->to(base_url() . '/forgot-password/auth')
                    ->with('msgForgotPassword', '<p class="alert alert-danger p-1 mb-2" role="alert">Email tidak ditemukan!</p>');
            }
        }
    }

    public function resetPassword($token = null)
    {
        if (session()->isLogin) return redirect()->to(base_url() . '/dashboard');
        $data['token'] = $token;
        $data['val'] = service('validation');

        $cek = $this->model->getWhere(['token' => $token])->getNumRows();

        // echo $cek;
        // die;
        if ($cek > 0) {
            $data['content'] = view('auth/resetPassword', $data);
        } else {
            $data['errorMsg'] = 'Token tidak valid!';
            $data['content'] = view('errors/e404', $data);
        }
        $data['sidebar'] = null;
        $data['footer'] = null;
        return view('cms/header', $data);
    }

    public function updatePassword($token = null)
    {
        $rules = [
            'password'  => 'required',
            'passconf'  => 'required|matches[password]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to(base_url() . '/reset-password/auth/'.$token)
                ->withInput();
        } else {
            $user = $this->model->where(['token'=>$token])->first();
            $data = [
                'password' => md5($this->request->getVar('password')),
                'token'    => '',
            ];
            $this->model->update($user['id'], $data);
            return redirect()->to(base_url() . '/login/auth')
                ->with('msgLogin', '<p class="alert alert-success p-1 mb-2" role="alert">Berhasil reset password, silahkan login!</p>');
        }
    }

}
