<?php

namespace Service\Provider;

class Sms implements ProviderInterface {
	
	function send($to, $text) {
		if(!$this->validatePhone($to)) {
			throw new \Exception('Неправильный номер телефона');
		}
		
		return $this->sendSms($to, $text);
	}
	
	/**
	 * Какая-либо валидация телефона
	 * @param $to
	 * @return bool
	 */
	private function validatePhone($to): bool {
		if(strlen($to) == 10) {
			return true;
		}
		
		return false;
	}
	
	/**
	 * Отправка СМС
	 * @param $to
	 * @param $text
	 * @return void
	 */
	private function sendSms($to, $text): array {
		// тут результат отправки
		$response = true;
		
		if($response) {
			return (new ResultRequest())->getResult();
		}
	}
}