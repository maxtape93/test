<?php

namespace Controllers;

use Service\Generator;
use Service\Provider\ResultRequest;
use Service\Provider\Sms;
use Service\User;

class SmsController extends AbstractController {
	
	public function send() {
		$phone = $this->getPostData()['phone'];
		
		$userEntity = User::getEntityByParams(
			[
				'phone' => $phone
			]
		);
		
		if(!$userEntity instanceof User) {
			throw new \Exception('Пользователь не найден');
		}
		
		if(User::isActiveCode($userEntity)) {
			throw new \Exception('Нельзя так часто посылать запросы');
		}
		
		$code = Generator::getCode();
		
		$result = (new Sms())->send($phone, $code);
		if($result['status'] == ResultRequest::SUCCESS) {
			User::setCode($userEntity, $code);
			
			// todo
			return ['status' => 'success', 'userId' => $userEntity->getId()];
		}
		
		// todo
		return ['status' => 'error', 'userId' => null];
	}
}