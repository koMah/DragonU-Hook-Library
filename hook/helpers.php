<?php
namespace DragonU\Hook;
/**
 * Includes helpers for simplifying adding to hooks.
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
 * Includes helpers for using a single method for adding and removing from the hooks.
 *
 * @since 0.1
 */
interface Helpers
{

	/**
	 * Adds callable to single hook.
	 *
	 * @since 0.1
	 *
	 * @param string $name The name of the hook to attach callable.
	 * @param callable|Hookable $callable Callable value or hookable class.
	 * @param int $priority Optional, defaults to 10.
	 * @return bool Whether callable was added.
	 */
	public function add($name, $callable, $priority = 10);

	/**
	 * Remove callable from single hook.
	 *
	 * @since 0.1
	 *
	 * @param string $name The name of the hook to attach callable.
	 * @param callable|Hookable $callable Callable value or hookable class.
	 * @param int $priority Optional, defaults to 10.
	 * @return bool Whether callable was removed.
	 */
	public function remove($name, $callable, $priority = 10);
}