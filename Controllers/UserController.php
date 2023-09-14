<?php

namespace Controllers;

use Service\User;
use Service\UserSetting;

class UserController extends AbstractController {
	protected $serviceDefault = User::class;
	
	public function checkCodeAction() {
		$code = $this->getPostData()['code'];
		$userId = $this->getPostData()['userId'];
		
		if(!User::checkCode()) {
			throw new \Exception('Код не совпадает');
		}
		
		return ['status' => 'success'];
	}
	
	/**
	 * @param $id
	 * @param $data
	 * @return void
	 */
	public function update($id, $data) {
		if($data['updateSetting']) {
			return UserSetting::save($id, $data);
		}
	}
}