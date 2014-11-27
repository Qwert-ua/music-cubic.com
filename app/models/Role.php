<?php

class Role extends Eloquent {

	protected $table = 'roles';
	//protected $guarded = array();
	
	public function users()
    {
        return $this->belongsToMany('User', 'users_roles');
    }

}
