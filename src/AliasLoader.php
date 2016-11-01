<?php 

/**
 *
 * AliasLoader
 *
 * @package		Packager
 * @subpackage	AliasLoader
 * @license    	http://www.gnu.org/licenses/gpl.txt  GNU GPL 3.0
 * @author     	Omar Andrés Barbosa Ortiz
 * @link       	http://omarbarbosa.com
 *
 */

namespace Barbosa\Packager;

class AliasLoader
{
	/**
	 * $aliases Services name with namespaces as value
	 * 
	 * @var array
	 */
	private static $aliases =[];

	/**
	 * setAliases Set aliases array
	 * 
	 * @param array|null $aliases Aliases array
	 */
	public static function setAliases(array $aliases = null)
	{
		if (!empty($aliases)) {
			foreach ($aliases as $alias => $namespace) {
				self::$aliases[$alias] = $namespace;
			}
		}
	}

	/**
	 * getAliases Return $aliases, static property 
	 * 
	 * @return array Aliases array
	 */
	public static function getAliases()
	{
		return self::$aliases;
	}
}