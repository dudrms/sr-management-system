<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class CodeModel extends Model
{
    protected $table = 'codes';

    protected $primaryKey = 'code';
 
    protected $allowedFields = ['code', 'description','category'];
}