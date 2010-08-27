# DragonU #

DragonU is the company behind the library and also the namespace. The reasoning for this, is that my
name or any person's name is not a good namespace for a project. By having it DragonU, it allows for
reasonable separation from myself and jacobsantos.com.

# Hooks #

Hooks are a neat way to extend a library without having to build a full adapter class structure. The
ease of calling, adding, and removing hooks makes the unified structure very easy for beginners to
advanced programmers use the library.

It is similar to the Observer pattern, but the difference is that it isn't applied to a single class
or interface and is independent on any one class or function.

There are generally two different types of hooks: one for getting changes to a value and another
that doesn't need to return values. The first is generally called a filter, if using WordPress terms
and the second is more of an event or an action in WordPress terms.

# Examples #

## Calling a Hook ##

\DragonU\Hook\Filter('name')->execute($value);
\DragonU\Hook\Filter('name')->execute($value, $extra1, $extra2);

\DragonU\Hook\Event('name')->execute();
\DragonU\Hook\Event('name')->execute($value1, $value2);

## Adding to a Hook ##

\DragonU\Hook\Filter('name')->add(new \DragonU\Hook\FilterHook());
\DragonU\Hook\Filter('name')->add('function_name');
\DragonU\Hook\Filter('name')->add(array('class_name', 'method_name')); // Static
\DragonU\Hook\Filter('name')->add(array($object, 'method_name')); // Dynamic

$closure = function($value) {
	return $value;
}
\DragonU\Hook\Filter('name')->add($closure);

\DragonU\Hook\Event('name')->add(new \DragonU\Hook\EventHook());
\DragonU\Hook\Event('name')->add('function_name');
\DragonU\Hook\Event('name')->add(array('class_name', 'method_name')); // Static
\DragonU\Hook\Event('name')->add(array($object, 'method_name')); // Dynamic

$closure = function($value) {
	return $value;
}
\DragonU\Hook\Event('name')->add($closure);

## Removing a Hook ##

\DragonU\Hook\Filter('name')->remove(new \DragonU\Hook\FilterHook());
\DragonU\Hook\Filter('name')->remove('function_name');
\DragonU\Hook\Filter('name')->remove(array('class_name', 'method_name')); // Static
\DragonU\Hook\Filter('name')->remove(array($object, 'method_name')); // Dynamic

$closure = function($value) {
	return $value;
}
\DragonU\Hook\Filter('name')->remove($closure);

\DragonU\Hook\Event('name')->remove(new \DragonU\Hook\EventHook());
\DragonU\Hook\Event('name')->remove('function_name');
\DragonU\Hook\Event('name')->remove(array('class_name', 'method_name')); // Static
\DragonU\Hook\Event('name')->remove(array($object, 'method_name')); // Dynamic

$closure = function($value) {
	return $value;
}
\DragonU\Hook\Event('name')->remove($closure);

## Checking Current Hook that is Running ##

$current = \DragonU\Hook\current();