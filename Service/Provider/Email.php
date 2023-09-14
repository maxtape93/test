<?php

namespace Service\Provider;

class Email implements ProviderInterface {
	
	public function send($to, $text) {
		if(!$this->validateEmail($to)) {
			throw new \Exception('Неправильный формат почты');
		}
		
		return $this->sendEmail($to, $text);
	}
	
	private function validateEmail($to): bool {
		return true;
	}
	
	/**
	 * @param $to
	 * @param $text
	 * @return array
	 */
	private function sendEmail($to, string $text): array {
		// тут результат отправки
		$response = true;
		
		if($response) {
			return (new ResultRequest())->getResult();
		}
	}
}