<?php 

namespace Barbosa\Packager;
/**
* 
*/
class AliasLoader
{
	private static $aliases =[];

	public static function setAliases(array $aliases = null)
	{
		if (!empty($aliases)) {
			self::$aliases = $aliases;
		}
	}

	public static function getAliases()
	{
		return self::$aliases;
	}
}