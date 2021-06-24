<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\CodeModel;
use App\Models\SrModel;
 
class Sr extends Controller
{
    public function index($popup = null)
    { 
        $session = session();
        helper(['form', 'url']);
        $logged_in = $session->get('logged_in');
        if ($logged_in != 1) {
            return view('login');
        } 

        $from = $this->request->getVar('from');
        $to = $this->request->getVar('to');
        $status = $this->request->getVar('status');
        $manager = $this->request->getVar('manager');

        
        if ($from == '' && $to == '' || $from == null && $to == null ) {
            $from = date("Y-m",strtotime ("-1 months"))."-01";
            $to = date("Y-m")."-31"; 
        }

        //세션에 저장
        $newdata = array(
            'from' => $from,
            'to' => $to,
            'status'  => $status,
            'manager'  => $manager
            );
        $session->set($newdata);

        $data['con'] = [
            'from' => $from,
            'to' => $to,
            'status'  => $status,
            'manager'  => $manager,
        ];

        $db = db_connect();

        if ($status == 'ST10') {
            $sql = "SELECT * FROM sr_v WHERE complete_date BETWEEN '".$from."' and '".$to."' and manager like '".$manager."%"."' order by sr_id desc";
        } elseif ($status != 'ST10') {
            $sql = "SELECT * FROM sr_v WHERE occur_date BETWEEN '".$from."' and '".$to."' and status like '".$status."%"."' and manager like '".$manager."%"."' order by sr_id desc";
        }
      

        $query = $db->query($sql);
        $data['sr'] = $query->getResult('array');

        $model = new CodeModel();
        $data['status'] = $model->where('category', 'status')->orderBy('code', 'ASC')->findAll();

        $model = new UserModel();
        $data['users'] = $model->orderBy('id', 'ASC')->findAll();

        if ($popup == 'y') {
            return view('popup-sr', $data);
        } else {
            return view('sr', $data);
        }

    }
    public function cancel($popup = null)
    { 
        $session = session();
        helper(['form', 'url']);
        $logged_in = $session->get('logged_in');
        if ($logged_in != 1) {
            return view('login');
        } 

        $from = $session->get('from');
        $to = $session->get('to');
        $status = $session->get('status');
        $manager = $session->get('manager');

        $data['con'] = [
            'from' => $from,
            'to' => $to,
            'status'  => $status,
            'manager'  => $manager,
        ];

        $db = db_connect();

        if ($status == 'ST10') {
            $sql = "SELECT * FROM sr_v WHERE complete_date BETWEEN '".$from."' and '".$to."' and manager like '".$manager."%"."' order by sr_id desc";
        } elseif ($status != 'ST10') {
            $sql = "SELECT * FROM sr_v WHERE occur_date BETWEEN '".$from."' and '".$to."' and status like '".$status."%"."' and manager like '".$manager."%"."' order by sr_id desc";
        }
      

        $query = $db->query($sql);
        $data['sr'] = $query->getResult('array');

        $model = new CodeModel();
        $data['status'] = $model->where('category', 'status')->orderBy('code', 'ASC')->findAll();

        $model = new UserModel();
        $data['users'] = $model->orderBy('id', 'ASC')->findAll();

        if ($popup == 'y') {
            return view('popup-sr', $data);
        } else {
            return view('sr', $data);
        }

    }
    public function create()
    {    
        $session = session();
        $model = new CodeModel();
 
        $data['type1'] = $model->where('category', 'type1')->orderBy('code', 'ASC')->findAll();
        $data['type2'] = $model->where('category', 'type2')->orderBy('code', 'ASC')->findAll();
        $data['type3'] = $model->where('category', 'type3')->orderBy('code', 'ASC')->findAll();
        $data['status'] = $model->where('category', 'status')->orderBy('code', 'ASC')->findAll();

        return view('create-sr', $data);
    }

    public function store()
    {    
        $session = session();
        helper(['form', 'url']);

        $db = db_connect();
        $query = $db->query("select count(*) cnt from sr where sr_id like concat(date_format(NOW(),'%Y%m%d'),'%')");
        foreach ($query->getResult('array') as $row) { $cnt = $row['cnt']; }

        //SR-ID 만들기 YYYYMMDD999
        $today = strval(date("Ymd"));

        //create_date
        $create_date = strval(date("Y-m-d"));

        if ( $cnt == 0 ) {
            $sr_id = $today."001";
        } else {
            $sr_id = $today.str_pad(($cnt)+1,3,"0",STR_PAD_LEFT);
        }
        $model = new SrModel();

        $data = [
            'sr_id' => $sr_id,
            'title' => $this->request->getVar('title'),
            'content'  => $this->request->getVar('content'),
            'type1'  => $this->request->getVar('type1'),
            'type2'  => $this->request->getVar('type2'),
            'type3'  => $this->request->getVar('type3'),
            'status'  => $this->request->getVar('status'),
            'client_dept'  => $this->request->getVar('client_dept'),
            'client'  => $this->request->getVar('client'),
            'manager'  => $this->request->getVar('manager'),
            'occur_date'  => $this->request->getVar('occur_date'),
            'require_date'  => $this->request->getVar('require_date'),
            'complete_date'  => $this->request->getVar('complete_date'),
            'work_hour'  => $this->request->getVar('work_hour'),
            'amt_new'  => $this->request->getVar('amt_new'),
            'amt_modify'  => $this->request->getVar('amt_modify'),
            'create_date'  => $create_date,
            ];

        $save = $model->insert($data);

        $subject = '[ SR ' . $sr_id . ' 접수 ]' . $this->request->getVar('title');
        $to ='dudrms81@poscoict.com'; //$this->request->getVar('mail_to');
        $message = $this->request->getVar('content');

        $headers = 'MIME-Version: 1.0'. "\r\n" . 
            'Content-Type: text/html; charset=utf-8'. "\r\n" . 
            'From: ' . 'SR_Manager@poscoict.com' . "\r\n" . 
            'Reply-To: dudrms81@poscoict.com' . "\r\n" . 
            'X-Mailer: PHP/' . phpversion(); 

        mail($to, "=?UTF-8?B?".base64_encode($subject)."?=", $message, $headers);

        return redirect()->to( base_url('/sr') );
    }

    public function delete($sr_id = null)
    {
        $session = session();
        $model = new SrModel();
 
        $data['sr'] = $model->where('sr_id', $sr_id)->delete();
      
        return redirect()->to( base_url('/sr') );
    }

    public function edit($sr_id = null)
    {
        $session = session();
        $model = new SrModel();
        $data['sr'] = $model->find($sr_id); //반드시 모델에 PK를 정의해줘야함. 세시간 날림!

        $model = new CodeModel();
        $data['type1'] = $model->where('category', 'type1')->orderBy('code', 'ASC')->findAll();
        $data['type2'] = $model->where('category', 'type2')->orderBy('code', 'ASC')->findAll();
        $data['type3'] = $model->where('category', 'type3')->orderBy('code', 'ASC')->findAll();
        $data['status'] = $model->where('category', 'status')->orderBy('code', 'ASC')->findAll();

        return view('/edit-sr', $data);
    }

    public function view($sr_id = null, $popup = null)
    {
        $session = session();
        $model = new SrModel();
        $data['sr'] = $model->find($sr_id); //반드시 모델에 PK를 정의해줘야함. 세시간 날림!

        $model = new CodeModel();
        $data['type1'] = $model->where('category', 'type1')->orderBy('code', 'ASC')->findAll();
        $data['type2'] = $model->where('category', 'type2')->orderBy('code', 'ASC')->findAll();
        $data['type3'] = $model->where('category', 'type3')->orderBy('code', 'ASC')->findAll();
        $data['status'] = $model->where('category', 'status')->orderBy('code', 'ASC')->findAll();

        if ($popup == 'y') {
            return view('/popup-view-sr', $data);
        } else {
            return view('/view-sr', $data);
        }
        
    }

    public function update()
    {  
        $session = session();
        helper(['form', 'url']);
         
        $model = new SrModel();
 
        $sr_id = $this->request->getVar('sr_id');
        //update_date
        $update_date = strval(date("Y-m-d"));
 
        $data = [
            'title' => $this->request->getVar('title'),
            'content'  => $this->request->getVar('content'),
            'type1'  => $this->request->getVar('type1'),
            'type2'  => $this->request->getVar('type2'),
            'type3'  => $this->request->getVar('type3'),
            'status'  => $this->request->getVar('status'),
            'client_dept'  => $this->request->getVar('client_dept'),
            'client'  => $this->request->getVar('client'),
            'manager'  => $this->request->getVar('manager'),
            'occur_date'  => $this->request->getVar('occur_date'),
            'require_date'  => $this->request->getVar('require_date'),
            'complete_date'  => $this->request->getVar('complete_date'),
            'work_hour'  => $this->request->getVar('work_hour'),
            'amt_new'  => $this->request->getVar('amt_new'),
            'amt_modify'  => $this->request->getVar('amt_modify'),
            'update_date'  => $update_date,
            ];
 
        $save = $model->update($sr_id,$data);
 
        return redirect()->to( base_url('/sr') );
    }

    public function refer1()
    {
        return view('/refer1');
    }

    public function refer2()
    {
        return view('/refer2');
    }

    public function refer3()
    {
        return view('/refer3');
    }


}