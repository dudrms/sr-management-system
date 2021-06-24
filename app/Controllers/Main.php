<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
 
class Main extends Controller
{
    public function index()
    {    
        $session = session();
        $logged_in = $session->get('logged_in');
        if ($logged_in != 1) {
            return view('login');
        } 

        $yyyymm = $this->request->getVar('yyyymm');
        $yyyy = substr($this->request->getVar('yyyymm'),0,4);
        $pyyyy = date("Y")-1;
        $yyyy_mm = substr($this->request->getVar('yyyymm'),0,4)."-".substr($this->request->getVar('yyyymm'),4,2);
        
        $temp_yyyy_mm_dd7 = strtotime(date("Y-m-d").'+7 days');
        $yyyy_mm_dd7 = date('Y-m-d',$temp_yyyy_mm_dd7);

        if ($yyyymm == '' || $yyyymm == null ) {
            $yyyy = date("Y");
            $pyyyy = date("Y")-1;
            $yyyymm = date("Ym");
            $yyyy_mm = date("Y-m");
            
            $temp_yyyy_mm_dd7 = strtotime(date("Y-m-d").'+7 days');
            $yyyy_mm_dd7 = date('Y-m-d',$temp_yyyy_mm_dd7);
        }

        $data['con'] = [
            'yyyy' => $yyyy,
            'yyyymm' => $yyyymm,
            'yyyy_mm' => $yyyy_mm,
        ];

        $db = db_connect();

        //전체누적
        $sql = "select t.yyyy ,sum(this_year_recv) this_year_recv, sum(previous_year_recv) previous_year_recv, sum(this_year_complete) this_year_complete, sum(processing) processing, sum(t.step1) + sum(t.step2) + sum(t.step3) total, sum(t.step1) step1, sum(t.step2) step2, sum(t.step3) step3, sum(t.cancel) cancel, sum(t.delay) delay  from (
select substr(occur_date,1,4) yyyy,
IF(occur_date like '".$yyyy."%"."' and status != 'ST99',1,0) as this_year_recv,
IF(occur_date < '".$yyyy."-01-01"."' and complete_date = '' and status != 'ST99' ,1,0) as previous_year_recv,
IF(complete_date like '".$yyyy."%"."' and status != 'ST99' ,1,0) as this_year_complete,
IF((occur_date like '".$yyyy."%"."' or occur_date < '".$yyyy."-01-01"."') and complete_date = '',1,0 and status != 'ST99') as processing,
IF(status = 'ST01',1,0) as step1,
IF(status = 'ST05',1,0) as step2,
IF(status = 'ST10',1,0) as step3,
IF(status = 'ST99',1,0) as cancel,
IF(complete_date ='',
IF((str_to_date(date_format(now(),'%Y-%m-%d'),'%Y-%m-%d') - str_to_date(require_date,'%Y-%m-%d')) > 0,1,0) ,0) as delay
from sr where sr_id in (select x.sr_id from (
select sr_id from sr_v where occur_date like '".$yyyy."%"."' and complete_date = '' union
select sr_id from sr_v where occur_date like '".$yyyy."%"."' and complete_date like '".$yyyy."%"."' union
select sr_id from sr_v where occur_date < '".$yyyy."-01-01"."' and complete_date = '' union
select sr_id from sr_v where occur_date < '".$yyyy."-01-01"."' and complete_date like '".$yyyy."%"."'
) x)
) t group by t.yyyy WITH ROLLUP";

        $query = $db->query($sql);
        $data['s1s'] = $query->getResult('array');

        //연간 완료 실적
        $sql = "select yyyy, sum(m1) as m1
, sum(m2) as m2
, sum(m3) as m3
, sum(m4) as m4
, sum(m5) as m5
, sum(m6) as m6
, sum(m7) as m7
, sum(m8) as m8
, sum(m9) as m9
, sum(m10) as m10
, sum(m11) as m11
, sum(m12) as m12
from ( select 
substr(complete_date,1,4) yyyy,
IF(substr(complete_date,6,2) = '01' and status = 'ST10',1,0) as m1,
IF(substr(complete_date,6,2) = '02' and status = 'ST10',1,0) as m2,
IF(substr(complete_date,6,2) = '03' and status = 'ST10',1,0) as m3,
IF(substr(complete_date,6,2) = '04' and status = 'ST10',1,0) as m4,
IF(substr(complete_date,6,2) = '05' and status = 'ST10',1,0) as m5,
IF(substr(complete_date,6,2) = '06' and status = 'ST10',1,0) as m6,
IF(substr(complete_date,6,2) = '07' and status = 'ST10',1,0) as m7,
IF(substr(complete_date,6,2) = '08' and status = 'ST10',1,0) as m8,
IF(substr(complete_date,6,2) = '09' and status = 'ST10',1,0) as m9,
IF(substr(complete_date,6,2) = '10' and status = 'ST10',1,0) as m10,
IF(substr(complete_date,6,2) = '11' and status = 'ST10',1,0) as m11,
IF(substr(complete_date,6,2) = '12' and status = 'ST10',1,0) as m12
from sr_v where complete_date like '".$yyyy."%"."' ) t group by t.yyyy";

        $query = $db->query($sql);
        $data['s2s'] = $query->getResult('array');

        $sql = "select 
        count(*) as count,
substr(complete_date,6,2) as month_name
from sr_v where complete_date like '".$yyyy."%"."' group by substr(complete_date,6,2) order by substr(complete_date,6,2)";

        $query = $db->query($sql);
        $data['s3s'] = $query->getResult('array');

$sql = "select 
        count(*) as count,
substr(complete_date,6,2) as month_name
from sr_v where complete_date like '".$pyyyy."%"."' group by substr(complete_date,6,2) order by substr(complete_date,6,2)";

        $query = $db->query($sql);
        $data['s4s'] = $query->getResult('array');

$sql = "select 
        count(*) as count, type1_desc
from sr_v where complete_date like '".$yyyy."%"."' group by type1 order by type1";

        $query = $db->query($sql);
        $data['s5s'] = $query->getResult('array');

$sql = "
select sr_id, title, status_desc,require_date, manager from sr_v where require_date < '".$yyyy_mm_dd7."' and status not in ('ST99','ST10')";

        $query = $db->query($sql);
        $data['s6s'] = $query->getResult('array');

        //echo $yyyy_mm_dd7;

        return view('main',$data);
    }    

}