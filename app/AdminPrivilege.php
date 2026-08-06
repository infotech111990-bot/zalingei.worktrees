<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPrivilege extends Model
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'admin_privs';
    
        
        
        /**
         * The attributes excluded from the model's JSON form.
         *
         * @var array
         */
    
        
        protected $primaryKey='id';

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
                'userID', 'section', 'sectionID', 'dataCreate', 'dataUpdate', 'dataDelete'
        ];

        public function admin(){
                return $this->belongsTo(Admin::class,'userID');
        }

}
