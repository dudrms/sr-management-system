<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class SrModel extends Model
{
    protected $table = 'sr';

    protected $primaryKey = 'sr_id';
 
    protected $allowedFields = ['sr_id','title','content','type1','type2','type3','status','client_dept','client','manager','occur_date','require_date','complete_date','work_hour','amt_new','amt_modify','create_date','update_date'];
}