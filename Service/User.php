<?php

namespace Service;

class User {
	
	const TIME_ACTIVE_CODE = 3600;
	
	public static function getEntityByParams(array $params) {
		// тут какой-либо запрос в БД типа
		$sql = 'SELECT * FROM users WHERE ' . $params;
		
		return new \Entity\User();
	}
	
	public static function setCode(\Entity\User $userEntity, bool $code) {
		$sql = 'INSERT INTO user_code (user_id, code, date_time) values(' . $userEntity->getId() . ', "$code", ' . time() . ')';
	}
	
	public static function isActiveCode(\Entity\User $userEntity) {
		$userCode = 'SELECT *
		FROM user_code
        WHERE user_id = ' . $userEntity->getId() . ' AND date_time > ' . time() + TIME_ACTIVE_CODE;
		
		return count($userCode) > 0;
	}
}
