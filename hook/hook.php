<?php
namespace DragonU\Hook;
/**
 * Plugin Hook System.
 *
 * @package DragonU
 * @subpackage Hook
 * @license http://www.opensource.org/licenses/mit-license.html The MIT License
 * @author Jacob Santos
 * @since 0.1
 */

/**
 *
 */
class NotCallableException extends Exception { }

interface Hookable
{
	public function hook_parameters(array $parameters);

	public function max_parameters();

	public function run_hook();
}

interface AcceptHooks { }
interface SeparatedHooks { }

abstract class HookImplementation implements AcceptHooks
{
	static protected $hook_list = array();

	static protected $current_hook = '';

	public function add($name, $callable, $priority = 10)
	{
		try
		{
			$id = self::get_callable_id($callable);
			static::$hook_list[$name][$priority][$id] = $callable;
			return true;
		}
		catch( NotCallableException $e )
		{
			throw $e;
		}
	}

	public function remove($name, $callable, $priority = 10)
	{
		if( isset(static::$hook_list[$name]) && isset(static::$hook_list[$name][$priority]) )
		{
			try
			{
				$id = self::get_callable_id($callable);
				if( isset(static::$hook_list[$name][$priority][$id]) )
				{
					unset( static::$hook_list[$name][$priority][$id] );
				}
				return true;
			}
			catch( NotCallableException $e )
			{
				throw $e;
			}
		}

		return false;
	}

	public function execute($name)
	{

	}

	static protected function get_callable_id($callable)
	{
		// Since we call is_callable() too often, we'll do the check once. We also have to ensure
		// that the Hookable instances aren't passed over for being strict objects.
		if( ! is_callable($callable) && ! ( $callable instanceof Hookable ) ) // Might have bug.
		{
			throw new NotCallableException;
		}

		// This might be PHP5.3 closure or a regular class.
		if( is_object($callable) )
		{
			return spl_object_hash($callable);
		}

		if( is_string($callable) )
		{
			return $callable;
		}

		if( is_array($callable) )
		{
			if( is_string($callable[0]) )
			{
				return implode('::', $callable);
			}

			return spl_object_hash($callable[0]) . $callable[1];
		}

		throw new NotCallableException;
	}
}

class Plugin implements AcceptHooks
{
}

class SeparatedPlugin extends Plugin implements SeparatesHooks
{

}

abstract class PluginModel
{


}

class Filter extends PluginModel { }
class Event extends PluginModel { }
class Action extends PluginModel { }

/**
 *
 * @param string $name Hook name.
 */
function Filter($name)
{
	//
}

/**
 *
 * @param string $name Hook name.
 */
function Event($name)
{
	//
}

function current()
{
	
}