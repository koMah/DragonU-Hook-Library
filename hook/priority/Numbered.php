<?php
namespace DragonU\Hook\Priority;
/**
 * Numbered priority.
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
class Numbered implements \DragonU\Hook\Priority
{
	protected $value = 0;

	public function __construct($num = 10)
	{
		$this->value = (int) $num;
	}

	public function value()
	{
		return $this->value;
	}
}