<?php

namespace Modules\ManajemenAkun\Models;

use CodeIgniter\Model;

class ManajemenAkunModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'username', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash', 'status', 'status_message', 'active', 'force_pass_reset', 'created_at', 'created_update', 'deleted_at'];
    protected $returnType = 'object';
    protected $useSoftDeletes = 'true';

    public function getManajemenAkun($keyword = null)
    {
        $builder = $this->table($this->table);
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = ' . $this->table . '.id', 'LEFT');
        $builder->join('auth_groups', 'auth_groups.id  = auth_groups_users.group_id', 'LEFT');
        if ($keyword) {
            $builder->like('auth_groups.name', $keyword)->where('users.deleted_at', null);
            $builder->orlike($this->table . '.username', $keyword)->where($this->table . '.deleted_at', null);
            $builder->orlike($this->table . '.email', $keyword)->where($this->table . '.deleted_at', null);
        }
        $builder->orderBy($this->table . '.id', 'DESC');
        return $builder;
    }

    public function getSpecificUser($where)
    {
        $builder = $this->table($this->table);
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = ' . $this->table . '.id');
        $builder->join('auth_groups', 'auth_groups.id  = auth_groups_users.group_id');
        $builder->where($where);
        $query = $builder->get();
        return $query;
    }
}
