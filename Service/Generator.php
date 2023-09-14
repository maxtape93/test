<?php

namespace Service;

class Generator {
	public static function getCode() {
		return substr(md5(time()), 0, 5);
	}
}