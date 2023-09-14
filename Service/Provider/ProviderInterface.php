<?php

namespace Service\Provider;

interface ProviderInterface {
	public function send($to, $text);
}