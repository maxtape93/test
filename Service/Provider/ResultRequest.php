<?php

namespace Service\Provider;

class ResultRequest {
	const SUCCESS = 'success';
	
	public function __construct() {
	}
	
	public function getResult() {
		return ['status' => 'success'];
	}
}