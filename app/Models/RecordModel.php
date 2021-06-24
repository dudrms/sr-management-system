<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class RecordModel extends Model
{
    protected $table = 'record';
 
    protected $allowedFields = ['title', 'content', 'manager', 'record_date'];
}