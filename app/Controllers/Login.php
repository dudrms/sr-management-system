<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\UserModel;
 
class Login extends Controller
{
    public function index()
    {   
        $session = session();
        $logged_in = $session->get('logged_in');
        if ($logged_in == 1) {
            return redirect()->to( base_url('/main') );
        } else {
            return view('login');
        }
    }    
 
    public function in()
    {    
        
        helper(['form', 'url']);
        $username = $this->request->getVar('username');

        $db = db_connect();
        $sql = "SELECT count(*) cnt FROM users where name = '".$username."' ";
        $query = $db->query($sql);
        foreach ($query->getResult('array') as $row) { $cnt = $row['cnt']; }

        if ($cnt) {
            $newdata = array(
            'username'  => $username,
            'logged_in' => TRUE
            );
            $session = session();
            $session->set($newdata);
            return redirect()->to( base_url('/main') );
        } else {
            $info['msg'] = array(
            'message'  => '관리자에게 사용자 등록을 요청하세요'
            );
            return view('login',$info);
        }
    }

    public function out()
    {    
        $session = session();
        $session->destroy();
        return redirect()->to( base_url('/login') );
    }

}