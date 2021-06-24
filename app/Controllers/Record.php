<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\RecordModel;
 
class Record extends Controller
{
    public function index()
    { 
        $session = session();
        helper(['form', 'url']);
        $logged_in = $session->get('logged_in');
        if ($logged_in != 1) {
            return view('login');
        } 

        $from = $this->request->getVar('from');
        $to = $this->request->getVar('to');
        $manager = $this->request->getVar('manager');

        if ($from == '' && $to == '' || $from == null && $to == null ) {
            $from = date("Y-m",strtotime ("-1 months"))."-01";
            $to = date("Y-m")."-31"; 
        }

        //세션에 저장
        $newdata = array(
            'from' => $from,
            'to' => $to,
            'manager'  => $manager
            );
        $session->set($newdata);

        $data['con'] = [
            'from' => $from,
            'to' => $to,
            'manager'  => $manager,
        ];

        $db = db_connect();

        $sql = "SELECT * FROM record WHERE record_date BETWEEN '".$from."' and '".$to."' and manager like '".$manager."%"."' order by id desc";
      
        $query = $db->query($sql);
        $data['record'] = $query->getResult('array');

        $model = new UserModel();
        $data['users'] = $model->orderBy('id', 'ASC')->findAll();

        return view('record', $data);

    }
    public function cancel()
    { 
        $session = session();
        helper(['form', 'url']);
        $logged_in = $session->get('logged_in');
        if ($logged_in != 1) {
            return view('login');
        } 

        $from = $session->get('from');
        $to = $session->get('to');
        $manager = $session->get('manager');

        if ($from == '' && $to == '' || $from == null && $to == null ) {
            $from = date("Y-m",strtotime ("-1 months"))."-01";
            $to = date("Y-m")."-31"; 
        }

        //세션에 저장
        $newdata = array(
            'from' => $from,
            'to' => $to,
            'manager'  => $manager
            );
        $session->set($newdata);

        $data['con'] = [
            'from' => $from,
            'to' => $to,
            'manager'  => $manager,
        ];

        $db = db_connect();

        $sql = "SELECT * FROM record WHERE record_date BETWEEN '".$from."' and '".$to."' and manager like '".$manager."%"."' order by id desc";
      
        $query = $db->query($sql);
        $data['record'] = $query->getResult('array');

        $model = new UserModel();
        $data['users'] = $model->orderBy('id', 'ASC')->findAll();

        return view('record', $data);

    }
    public function create()
    {    
        $session = session();

        return view('create-record');
    }

    public function store()
    {    
        $session = session();
        helper(['form', 'url']);

        $db = db_connect();
        $model = new RecordModel();

        $data = [
            'title' => $this->request->getVar('title'),
            'content'  => $this->request->getVar('content'),
            'manager'  => $this->request->getVar('manager'),
            'record_date'  => $this->request->getVar('record_date')
            ];

        $save = $model->insert($data);

        return redirect()->to( base_url('/record') );
    }

    public function edit($id = null)
    {
        $session = session();
        $model = new RecordModel();
        $data['record'] = $model->find($id);

        return view('/edit-record', $data);
    }

    public function view($id = null)
    {
        $session = session();
        $model = new RecordModel();
        $data['record'] = $model->find($id); //반드시 모델에 PK를 정의해줘야함. 세시간 날림!

        return view('/view-record', $data);
    }

    public function update()
    {  
        $session = session();
        helper(['form', 'url']);
         
        $model = new RecordModel();
 
        $id = $this->request->getVar('id');
 
        $data = [
            'title' => $this->request->getVar('title'),
            'content'  => $this->request->getVar('content'),
            'record_date'  => $this->request->getVar('record_date')
            ];
 
        $save = $model->update($id,$data);
 
        return redirect()->to( base_url('/record') );
    }

}