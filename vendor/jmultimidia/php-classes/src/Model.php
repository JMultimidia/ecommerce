<?php
/**
 * Created by PhpStorm.
 * User: Johannes Nogueira
 * Date: 12/04/2018
 * Time: 12:06
 */

namespace JMultimidia;

class Model {
	private $values = [];
	public function __call($name, $args)
	{
		$method = substr($name, 0, 3);//a partir do caractere 0 traga 3
		$fieldName = substr($name, 3, strlen($name));//pega do 3 até o final
		switch ($method)
		{
			case "get":
				return $this->values[$fieldName];
				break;
			case "set":
				$this->values[$fieldName] = $args[0];
				break;
		}
	}
	public function setData($data = array())
	{
		foreach ($data as $key => $value) {

			$this->{"set".$key}($value);
		}
	}
	public function getValues()
	{
		return $this->values;
	}
}