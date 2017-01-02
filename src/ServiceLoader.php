<?php 

/**
 *
 * ServiceLoader
 *
 * @package	HackPack
 * @subpackage	ServiceLoader
 * @license    	http://www.gnu.org/licenses/gpl.txt  GNU GPL 3.0
 * @author     	Omar Andrés Barbosa Ortiz
 * @link       	http://omarbarbosa.com
 *
 */

namespace Barbosa\HackPack;

class ServiceLoader
{   
    /**
     * $stringFunction Function structure that retuns an object
     * 
     * @var string 
     */
    private static $stringFunction = "
        function NAME() {
            \$args = (func_num_args()) ? func_get_args() : [];
            \$reflection = new ReflectionClass('CLASS');
            return \$reflection->newInstanceArgs(\$args);
        }
    ";

    /**
     * Load services
     * 
     * @param array|null $services
     */
    public static function load(array $services = null)
    {
        if (!empty($services)) {
            foreach ($services as $name => $namespace) {
                if (self::verifyNamespace($namespace)) {
                    $replacement = [
                        'NAME' => $name,
                        'CLASS' => self::cleanNamespace((string) $namespace)
                    ];
                    
                    self::buildObejct($replacement);
                }
            }
        }
    }

    /**
     * Verify the namespace exists
     * 
     * @param string $namespace
     * @return bool
     */
    private static function verifyNamespace($namespace) 
    {
        try {
            if (class_exists($namespace)) {
                return true;
            } else {
                throw new \Exception("The {$namespace} class is not exists\n");
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    /**
     * Build object as functions
     * 
     * @param array $object
     */
    private static function buildObejct($object) 
    {
        $alias = str_replace(
            array_keys($object), 
            array_values($object), 
            self::$stringFunction
        );
        
        if(!function_exists($object['NAME'])) {
            eval($alias);
        }
    }
    
    /**
     * Delete chars not alloweb
     * 
     * @param string $namespace
     * @return string 
     */
    private static function cleanNamespace($namespace)
    {
        return preg_replace('/[0-9\.\/\-\>\<\(\)\[\]\#\$\,\?\*\{\}]/', '', $namespace);
    }
}