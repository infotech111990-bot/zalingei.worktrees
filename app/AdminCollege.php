<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminCollege extends Model
{
    protected $table = 'admin_colleges';
    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function college()
    {
        return $this->belongsTo(College::class, 'college_id');
    }
}
