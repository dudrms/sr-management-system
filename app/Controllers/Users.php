<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\UserModel;
 
class Users extends Controller
{
 
    public function index()
    {    
        $session = session();
        $logged_in = $session->get('logged_in');
        if ($logged_in != 1) {
            return view('login');
        } 

        $model = new UserModel();
 
        $data['users'] = $model->orderBy('id', 'DESC')->findAll();
            
        return view('users', $data);
    }    
 
    public function create()
    {    
        $session = session();
        return view('create-user');
    }
 
    public function store()
    {  
 
        $session = session();
        helper(['form', 'url']);
         
        $model = new UserModel();
 
        $data = [
 
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
            ];
 
        $save = $model->insert($data);
 
        return redirect()->to( base_url('/users') );
    }
 
    public function edit($id = null)
    {
        $session = session();
        $model = new UserModel();
     
        $data['user'] = $model->where('id', $id)->first();
     
        return view('/edit-user', $data);
    }
 
    public function update()
    {  
        $session = session();
        helper(['form', 'url']);
         
        $model = new UserModel();
 
        $id = $this->request->getVar('id');
 
        $data = [
 
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
            ];
 
        $save = $model->update($id,$data);
 
        return redirect()->to( base_url('/users') );
    }
 
    public function delete($id = null)
    {
        $session = session();
     $model = new UserModel();
 
     $data['user'] = $model->where('id', $id)->delete();
      
     return redirect()->to( base_url('/users') );
    }
}