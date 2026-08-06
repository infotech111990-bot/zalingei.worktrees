<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'job_title',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function getPriv(){
        $admin_priv = AdminPrivilege::where('userID','=',$this->id)->get();
        $priv_array = array();
        $i = 0;
        foreach($admin_priv as $admin_p){
            $priv_array[$i]['section'] = $admin_p->section;
            if($admin_p->sectionID == NULL || $admin_p->sectionID == 'all'){
                $priv_array[$i]['sectionID'] = array(null);
            }else{
                $sectionID_array = explode(',',$admin_p->sectionID);
                $priv_array[$i]['sectionID'] = $sectionID_array;
            }
            $i++;
        }
        return $priv_array;
    }
	
    public function hasMainPriv($prevName){
        $prev = $this->getPriv();
        foreach ($prev as $p){
            if(in_array('DBA',$p)){
                return true;
            }
        }
        foreach ($prev as $p){
            if(in_array($prevName,$p)){
                return true;
            }
        }
    }

    public function isDBA(){
        $prev = $this->getPriv();
        foreach ($prev as $p){
            if(in_array('DBA',$p)){
                return true;
            }
        }
    }
    
    public function hasListPriv($prevName){
        if($this->isDBA()){
            return false;
        }
        $prev = $this->getListPriv($prevName);
        if($prev[0] == NULL){
            return false;
        }else{
            return true;
        }
    }
    
    public function getListPriv($prevName){
        if(!$this->isDBA()){
            $admin_priv = AdminPrivilege::where('userID','=',$this->id)->where('section','=',$prevName)->first();
                if($admin_priv->sectionID == NULL || $admin_priv->sectionID == 'all'){
                    $priv_array = array(null);
                }else{
                    $sectionID_array = explode(',',$admin_priv->sectionID);
                    $priv_array = $sectionID_array;
                }
            return $priv_array;
        }else{
            $priv_array = array(null);
            return $priv_array;
        }
    }    

    public function hasActionPriv($prevName,$action){
        if(!$this->isDBA()){
            if($this->getListPriv($prevName)){
                $admin_priv = AdminPrivilege::where('userID','=',$this->id)->where('section','=',$prevName)->first();
                switch($action){
                    case 'create': if($admin_priv->dataCreate == 1) { return true; }
                    break;
                    case 'update': if($admin_priv->dataUpdate == 1) { return true; }
                    break;
                    case 'delete': if($admin_priv->dataDelete == 1) { return true; }
                    break;
                    case 'select': if($admin_priv->dataSelect == 1) { return true; }
                    break;
                    default: return false;
                }
            }else{
                return false;
            }
        }else{
            return true;
        }
    }    
    
}