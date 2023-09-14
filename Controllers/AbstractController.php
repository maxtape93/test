<?php

namespace Controllers;

abstract class AbstractController {
	
	protected $serviceDefault;
	
	/**
	 * Сюда посылаются запросы
	 * @return void
	 */
	public function init() {
		try {
			$this->dispatch();
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}
	
	private function dispatch() {
		$action = isset($_GET['action']) ? $_GET['action'] : '';
		$actionMethod = static::getMethodFromAction($action);
		
		if($action) {
			if (!method_exists($this, $actionMethod)) {
				$this->throwMethodNotAllowed();
			}
			$return = $this->$actionMethod();
		}
		
		$requestHttpMethod = strtoupper($_SERVER['REQUEST_METHOD']);
		
		switch ($requestHttpMethod) {
			case ('get'): {
				$id = $this->getIdFromRoute();
				return $this->get($id);
			} break;
			
			case ('post'): {
				$data = $this->getPostData();
				return $this->create($data);
			} break;
			
			case ('put'): {
				$id = $this->getIdFromRoute();
				$data = $this->getPostData();
				return $this->update($id, $data);
			} break;
		}
	}
	
	public static function getMethodFromAction($action)
	{
		$method  = str_replace(array('.', '-', '_'), ' ', $action);
		$method  = ucwords($method);
		$method  = str_replace(' ', '', $method);
		$method  = lcfirst($method);
		$method .= 'Action';
		
		return $method;
	}
	
	public function get($id) {
		$this->getServiceDefault()::getEntityById($id);
	}
	
	public function create() {
		$this->getServiceDefault()::create($data);
	}
	
	public function update($id, $data) {
		$this->getServiceDefault()::update($id, $data);
	}
	
	
	protected function getPostData() {
		return $_REQUEST['data'];
	}
	
	private function getIdFromRoute() {
		return 1;
	}
	
	protected function getServiceDefault() {
		return $this->serviceDefault;
	}
}