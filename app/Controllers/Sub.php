<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
 
class Sub extends Controller
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
        $yyyy_mm = substr($this->request->getVar('yyyymm'),0,4)."-".substr($this->request->getVar('yyyymm'),4,2);

        if ($yyyymm == '' || $yyyymm == null ) {
            $yyyy = date("Y");
            $yyyymm = date("Ym");
            $yyyy_mm = date("Y-m");
        }

        $data['con'] = [
            'yyyy' => $yyyy,
            'yyyymm' => $yyyymm,
            'yyyy_mm' => $yyyy_mm,
        ];

        $db = db_connect();

        //당월전체
        $sql = "select sum(this_month_recv) this_month_recv, sum(previous_month_recv) previous_month_recv, sum(this_month_complete) this_month_complete, sum(processing) processing, sum(t.step1)+sum(t.step2)+sum(t.step3) total, sum(t.step1) step1, sum(t.step2) step2, sum(t.step3) step3, sum(t.cancel) cancel, sum(t.delay) delay  from (
select substr(occur_date,1,7) yyyymm,
IF(occur_date like '".$yyyy_mm."%"."' and status != 'ST99' ,1,0) as this_month_recv,
IF(occur_date < '".$yyyy_mm."-01"."' and complete_date = '' and status != 'ST99',1,0) as previous_month_recv,
IF(complete_date like '".$yyyy_mm."%"."',1,0) as this_month_complete_200728,
IF(complete_date like '".$yyyy_mm."%"."' and status != 'ST99',1,0) as this_month_complete,
IF((occur_date like '".$yyyy_mm."%"."' or occur_date < '".$yyyy_mm."-01"."') and complete_date = '',1,0 and status != 'ST99') as processing,
IF(status = 'ST01',1,0) as step1,
IF(status = 'ST05',1,0) as step2,
IF(status = 'ST10',1,0) as step3,
IF(status = 'ST99',1,0) as cancel,
IF(complete_date ='',
IF((str_to_date(date_format(now(),'%Y-%m-%d'),'%Y-%m-%d') - str_to_date(require_date,'%Y-%m-%d')) > 0,1,0) ,0) as delay
from sr_v where sr_id in (select x.sr_id from (
select sr_id from sr_v where occur_date like '".$yyyy_mm."%"."' and complete_date = '' union
select sr_id from sr_v where occur_date like '".$yyyy_mm."%"."' and complete_date like '".$yyyy_mm."%"."' union
select sr_id from sr_v where occur_date < '".$yyyy_mm."-01"."' and complete_date = '' union
select sr_id from sr_v where occur_date < '".$yyyy_mm."-01"."' and complete_date like '".$yyyy_mm."%"."'
) x)
) t";
        $query = $db->query($sql);
        $data['s1'] = $query->getResult('array');

        //부문
        $sql = "select t.type1_desc, sum(t.step1) step1, sum(t.step2) step2, sum(t.step3) step3, sum(t.step1) + sum(t.step2) + sum(t.step3) total , sum(t.cancel) cancel, sum(t.delay) delay  from (
select type1_desc,
IF(status = 'ST01',1,0) as step1,
IF(status = 'ST05',1,0) as step2,
IF(status = 'ST10',1,0) as step3,
IF(status = 'ST99',1,0) as cancel,
IF(complete_date ='',
IF((str_to_date(date_format(now(),'%Y-%m-%d'),'%Y-%m-%d') - str_to_date(require_date,'%Y-%m-%d')) > 0,1,0) ,0) as delay
from sr_v where sr_id in (select x.sr_id from (
select sr_id from sr_v where occur_date like '".$yyyy_mm."%"."' and complete_date = '' union
select sr_id from sr_v where occur_date like '".$yyyy_mm."%"."' and complete_date like '".$yyyy_mm."%"."' union
select sr_id from sr_v where occur_date < '".$yyyy_mm."-01"."' and complete_date = '' union
select sr_id from sr_v where occur_date < '".$yyyy_mm."-01"."' and complete_date like '".$yyyy_mm."%"."'
) x)
) t group by t.type1_desc WITH ROLLUP";
        $query = $db->query($sql);
        $data['s2'] = $query->getResult('array');

        //모듈
        $sql = "select t.type1_desc, t.type2_desc, sum(t.step1) step1, sum(t.step2) step2, sum(t.step3) step3, sum(t.cancel) cancel, sum(t.delay) delay, sum(t.step1) + sum(t.step2) + sum(t.step3) tot, sum(amt_new) amt_new, sum(amt_modify) amt_modify , truncate(round(((sum(t.step1) + sum(t.step2) + sum(t.step3)) - sum(t.delay))/ ( sum(t.step1) + sum(t.step2) + sum(t.step3) ),2)*100,0) ratio from (
select type1_desc, type2_desc,
IF(status = 'ST01',1,0) as step1,
IF(status = 'ST05',1,0) as step2,
IF(status = 'ST10',1,0) as step3,
IF(status = 'ST99',1,0) as cancel,
IF(complete_date ='',
IF((str_to_date(date_format(now(),'%Y-%m-%d'),'%Y-%m-%d') - str_to_date(require_date,'%Y-%m-%d')) > 0,1,0) ,0) as delay,
amt_new, amt_modify
from sr_v where sr_id in (select x.sr_id from (
select sr_id from sr_v where occur_date like '".$yyyy_mm."%"."' and complete_date = '' union
select sr_id from sr_v where occur_date like '".$yyyy_mm."%"."' and complete_date like '".$yyyy_mm."%"."' union
select sr_id from sr_v where occur_date < '".$yyyy_mm."-01"."' and complete_date = '' union
select sr_id from sr_v where occur_date < '".$yyyy_mm."-01"."' and complete_date like '".$yyyy_mm."%"."'
) x)
) t group by t.type1_desc, t.type2_desc WITH ROLLUP";
        $query = $db->query($sql);
        $data['s3'] = $query->getResult('array');

        //작업유형
        $sql = "select t.type3_desc, sum(t.step1) step1, sum(t.step2) step2, sum(t.step3) step3, sum(t.cancel) cancel, sum(t.delay) delay  from (
select type3_desc,
IF(status = 'ST01',1,0) as step1,
IF(status = 'ST05',1,0) as step2,
IF(status = 'ST10',1,0) as step3,
IF(status = 'ST99',1,0) as cancel,
IF(complete_date ='',
IF((str_to_date(date_format(now(),'%Y-%m-%d'),'%Y-%m-%d') - str_to_date(require_date,'%Y-%m-%d')) > 0,1,0) ,0) as delay
from sr_v where sr_id in (select x.sr_id from (
select sr_id from sr_v where occur_date like '".$yyyy_mm."%"."' and complete_date = '' union
select sr_id from sr_v where occur_date like '".$yyyy_mm."%"."' and complete_date like '".$yyyy_mm."%"."' union
select sr_id from sr_v where occur_date < '".$yyyy_mm."-01"."' and complete_date = '' union
select sr_id from sr_v where occur_date < '".$yyyy_mm."-01"."' and complete_date like '".$yyyy_mm."%"."'
) x)
) t group by t.type3_desc";
        $query = $db->query($sql);
        $data['s4'] = $query->getResult('array');

        //모듈별 유형별 시간
        $sql = "SELECT t.type2_desc,
       t.type3_desc,
       sum(t.step1) step1,
       sum(t.step2) step2,
       sum(t.step3) step3,
       sum(t.cancel) cancel from (
select type2_desc, type3_desc,
IF(status = 'ST01',work_hour,0) as step1,
IF(status = 'ST05',work_hour,0) as step2,
IF(status = 'ST10',work_hour,0) as step3,
IF(status = 'ST99',work_hour,0) as cancel
from sr_v where sr_id in (select x.sr_id from (
select sr_id from sr_v where occur_date like '".$yyyy_mm."%"."' and complete_date = '' union
select sr_id from sr_v where occur_date like '".$yyyy_mm."%"."' and complete_date like '".$yyyy_mm."%"."' union
select sr_id from sr_v where occur_date < '".$yyyy_mm."-01"."' and complete_date = '' union
select sr_id from sr_v where occur_date < '".$yyyy_mm."-01"."' and complete_date like '".$yyyy_mm."%"."'
) x)
) t GROUP BY t.type2_desc, t.type3_desc WITH ROLLUP";
        $query = $db->query($sql);
        $data['s5'] = $query->getResult('array');

        //모듈별 유형별 시간2
        $sql = "SELECT t.type1_desc, t.type2_desc,
       sum(t.WT01) WT01,
       sum(t.WT02) WT02,
       sum(t.WT03) WT03,
       sum(t.WT04) WT04,
       sum(t.WT05) WT05,
       sum(t.WT06) WT06,
       sum(t.WT07) WT07,
       sum(t.WT08) WT08,
	   sum(t.WT09) WT09,
	   sum(t.WT10) WT10,
	   sum(t.WT11) WT11,
       sum(t.WT01) + sum(t.WT02) + sum(t.WT03) + sum(t.WT04) +sum(t.WT05) +sum(t.WT06) +sum(t.WT07) +sum(t.WT08) +sum(t.WT09) +sum(t.WT10) +sum(t.WT11) tot
        from (
select type1_desc, type2_desc,
IF(type3 = 'WT01',work_hour,0) as WT01,
IF(type3 = 'WT02',work_hour,0) as WT02,
IF(type3 = 'WT03',work_hour,0) as WT03,
IF(type3 = 'WT04',work_hour,0) as WT04,
IF(type3 = 'WT05',work_hour,0) as WT05,
IF(type3 = 'WT06',work_hour,0) as WT06,
IF(type3 = 'WT07',work_hour,0) as WT07,
IF(type3 = 'WT08',work_hour,0) as WT08,
IF(type3 = 'WT09',work_hour,0) as WT09,
IF(type3 = 'WT10',work_hour,0) as WT10,
IF(type3 = 'WT11',work_hour,0) as WT11
from sr_v where sr_id in (select x.sr_id from (
select sr_id from sr_v where occur_date like '".$yyyy_mm."%"."' and complete_date = '' union
select sr_id from sr_v where occur_date like '".$yyyy_mm."%"."' and complete_date like '".$yyyy_mm."%"."' union
select sr_id from sr_v where occur_date < '".$yyyy_mm."-01"."' and complete_date = '' union
select sr_id from sr_v where occur_date < '".$yyyy_mm."-01"."' and complete_date like '".$yyyy_mm."%"."'
) x)
) t GROUP BY t.type1_desc,t.type2_desc WITH ROLLUP";
        $query = $db->query($sql);
        $data['s5s'] = $query->getResult('array');


        //매니저별 작업량
        $sql = "select manager, type1_desc, count(*) work_count, sum(work_hour) as work_hour, sum(amt_new) as amt_new, sum(amt_modify) as amt_modify, 
        
        sum(IF(status = 'ST01',1,0)) + sum(IF(status = 'ST05',1,0)) as processing,

        sum(IF(complete_date ='',
IF((str_to_date(date_format(now(),'%Y-%m-%d'),'%Y-%m-%d') - str_to_date(require_date,'%Y-%m-%d')) > 0,1,0) ,0)) as delay
from sr_v where sr_id in (select x.sr_id from (
select sr_id from sr_v where occur_date like '".$yyyy_mm."%"."' and complete_date = '' union
select sr_id from sr_v where occur_date like '".$yyyy_mm."%"."' and complete_date like '".$yyyy_mm."%"."' union
select sr_id from sr_v where occur_date < '".$yyyy_mm."-01"."' and complete_date = '' union
select sr_id from sr_v where occur_date < '".$yyyy_mm."-01"."' and complete_date like '".$yyyy_mm."%"."'
) x)
group by manager, type1_desc WITH ROLLUP";
        $query = $db->query($sql);
        $data['s6'] = $query->getResult('array');

        
        //주요업무
        $sql = " select id, title, content, record_date, manager from record where record_date like '".$yyyy_mm."%"."' ";
        $query = $db->query($sql);
        $data['s7'] = $query->getResult('array');

        return view('sub',$data);
    }    

}

