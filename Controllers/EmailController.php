<?php

namespace Controllers;

use Service\Generator;
use Service\Provider\Email;
use Service\Provider\ResultRequest;
use Service\User;

class EmailController extends AbstractController {
	public function send() {
		$email = $this->getPostData()['email'];
		
		$userEntity = User::getEntityByParams(
			[
				'email' => $email
			]
		);
		
		if(!$userEntity instanceof User) {
			throw new \Exception('Пользователь не найден');
		}
		
		if(User::isActiveCode($userEntity)) {
			throw new \Exception('Нельзя так часто посылать запросы');
		}
		
		$code = Generator::getCode();
		
		$result = (new Email())->send($email, $code);
		
		if($result['status'] == ResultRequest::SUCCESS) {
			User::setCode($userEntity, $code);
			
			return ['status' => 'success', 'userId' => $userEntity->getId()];
		}
		
		return ['status' => 'error', 'userId' => null];
	}
}