<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\CodeModel;
 
class Codes extends Controller
{
 
    public function index()
    {    
        $session = session();
        $logged_in = $session->get('logged_in');
        if ($logged_in != 1) {
            return view('login');
        } 

        $model = new CodeModel();
 
        $data['codes'] = $model->orderBy('code', 'DESC')->findAll();
            
        return view('codes', $data);
    }    
 
    public function create()
    {    
        $session = session();
        return view('create-code');
    }
 
    public function store()
    {  
 
        $session = session();
        helper(['form', 'url']);
        
        $model = new CodeModel();

        $data = [
 
            'code' => $this->request->getVar('code'),
            'description'  => $this->request->getVar('description'),
            'category'  => $this->request->getVar('category'),
            ];
 
        $save = $model->insert($data);
 
        return redirect()->to( base_url('/codes') );
    }
 
    public function edit($code = null)
    {
        $session = session();
        $model = new CodeModel();
 
        $data['code'] = $model->where('code', urldecode($code))->first();
 
        return view('/edit-code', $data);
    }
 
    public function update()
    {  
        $session = session();
        helper(['form', 'url']);
         
        $model = new CodeModel();
 
        $code = $this->request->getVar('code');
 
        $data = [
             'description'  => $this->request->getVar('description'),
            'categogy'  => $this->request->getVar('categogy'),
            ];
 
        $save = $model->update($code,$data);
 
        return redirect()->to( base_url('/codes') );
    }
 
    public function delete($code = null)
    {
        $session = session();
        $model = new CodeModel();
 
        $data['code'] = $model->where('code', $code)->delete();
      
     return redirect()->to( base_url('/codes') );
    }
}