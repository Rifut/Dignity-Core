<?php

class ChatUser extends ChatBase{
	
	protected $name = '';
	
	public function save(){
		
		DB::query("
			INSERT INTO webchat_users (name)
			VALUES (
				'".DB::esc($this->name)."'
		)");
		
		return DB::getMySQLiObject();
	}
	
	public function update(){
		DB::query("
			INSERT INTO webchat_users (name)
			VALUES (
				'".DB::esc($this->name)."'
			) ON DUPLICATE KEY UPDATE last_activity = NOW()");
	}
}

?>