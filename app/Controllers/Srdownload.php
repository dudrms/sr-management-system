<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\CodeModel;
use App\Models\SrModel;
 
class Srdownload extends Controller
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
            $sql = "SELECT `sr_id`, `title`, 
            trim(left(REGEXP_REPLACE(`content`, '<[^>]*>|\&([^;])*;', ''), 3000)) ctx, 
            `type1`, `type2`, `type3`, `type1_desc`, `type2_desc`, `type3_desc`, `status`, `status_desc`, `client_dept`, `client`, `manager`, `occur_date`, `require_date`, `complete_date`, `work_hour`, `amt_new`, `amt_modify` FROM sr_v WHERE complete_date BETWEEN '".$from."' and '".$to."' and manager like '".$manager."%"."' order by sr_id desc";
        } elseif ($status != 'ST10') {
            $sql = "SELECT `sr_id`, `title`, 
            trim(left(REGEXP_REPLACE(`content`, '<[^>]*>|\&([^;])*;', ''), 3000)) ctx, 
            `type1`, `type2`, `type3`, `type1_desc`, `type2_desc`, `type3_desc`, `status`, `status_desc`, `client_dept`, `client`, `manager`, `occur_date`, `require_date`, `complete_date`, `work_hour`, `amt_new`, `amt_modify` FROM sr_v WHERE occur_date BETWEEN '".$from."' and '".$to."' and status like '".$status."%"."' and manager like '".$manager."%"."' order by sr_id desc";
        }
      

        $query = $db->query($sql);
        $data['sr'] = $query->getResult('array');

        $model = new CodeModel();
        $data['status'] = $model->where('category', 'status')->orderBy('code', 'ASC')->findAll();

        $model = new UserModel();
        $data['users'] = $model->orderBy('id', 'ASC')->findAll();

        return view('sr-download', $data);

    }
    
}