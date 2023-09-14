<?php

namespace Service;

interface ModelInterface {
	public function get(int $id);
	public function create(array $data);
	public function update(int $id, array $data);
}