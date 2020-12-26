<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = "services";
    protected $primaryKey = 'id';
    protected $returnType = 'object'; // protected $returnType = 'object';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['url', 'title', 'description', 'price', 'image', 'rank', 'isActive'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function search($keyword)
    {
     /*   $builder = $this->table('services');
        $builder->like('name',$keyword);
        return $builder;*/
        return $this->table('services')->like('title',$keyword)->orLike('description',$keyword);
    }
}
