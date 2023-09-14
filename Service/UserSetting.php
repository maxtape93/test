<?php

namespace Service;

class UserSetting implements ModelInterface {
	
	public function get(int $id) {
		// TODO: Implement get() method.
	}
	
	public function create(array $data) {
		// TODO: Implement create() method.
	}
	
	public function update(int $id, array $data) {
		$sql = '
update user_setting
SET setting_value = '. $data['settingValue'] . '
WHERE user_id = ' . $id . ' AND setting_name = ' . $data['settingName'];
	}
}