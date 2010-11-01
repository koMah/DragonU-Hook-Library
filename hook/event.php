<?php
namespace DragonU\Hook;
/**
 * Event class.
 *
 * @internal
 *
 * Copyright (c) 2010 Jacob Santos
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and
 * associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute,
 * sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or
 * substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT
 * NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
 * DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @package DragonU
 * @subpackage Hook
 * @license http://www.opensource.org/licenses/mit-license.html The MIT License
 * @author Jacob Santos
 * @since 0.1
 */

/**
 * Processed similar to a Hook a combination of the Registry pattern and Observer pattern.
 *
 * It is different from the Observer pattern in that it handles or registers all available functions
 * or callable types similar to that of an operating system hook. The Observer pattern works by
 * assigning multiple objects (observer) to a single object (subject) and then executing. The
 * problem is that the programmer is required to know which object to attach their object and the
 * observer object has to be available to all that require its facility.
 *
 * The Hook implementation solves the problem of where to attach the callable function or class as
 * all of the hooks are located in one place and called from the same place. Simplifying that part
 * at least. The other helpful part is that while the Observer pattern is great for unique processes
 * the Hook system is a more generic one. A class or function that hooks to an event is able to do
 * anything it needs as long as it simply returns the result.
 *
 * The problem is that it is probably slower than the Observer pattern, in that the parameters are
 * dynamic and special care has to be taken in order to allow every function and class method to
 * handle the parameters.
 *
 * @link http://en.wikipedia.org/wiki/Hook_(programming)
 * @link http://en.wikipedia.org/wiki/Observer_pattern
 */
class Event implements Hook, Helpers
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