<?php
namespace System\Utility;

class Arr
{
	/**
	 * Sets an array value using "dot notation".
	 *
	 * @param   array  $array Array you want to modify
	 * @param   string $path  Array path
	 * @param   mixed  $value Value to set
	 */
	public static function set(array &$array, $path, $value)
	{
		$segments = explode('.', $path);

		while (count($segments) > 1) {
			$segment = array_shift($segments);

			if (! isset($array[$segment]) or ! is_array($array[$segment])) {
				$array[$segment] = [];
			}

			$array =& $array[$segment];
		}

		$array[array_shift($segments)] = $value;
	}

	/**
	 * Search for an array value using "dot notation".
	 *
	 * @param   array  $array Array we're going to search
	 * @param   string $path  Array path
	 * @return  boolean Returns TRUE if the array key exists and FALSE if not.
	 */
	public static function has(array $array, $path)
	{
		$segments = explode('.', $path);

		foreach ($segments as $segment) {
			if (! is_array($array) or ! isset($array[$segment])) {
				return false;
			}

			$array = $array[$segment];
		}

		return true;
	}

	/**
	 * Returns value from array using "dot notation".
	 *
	 * @param   array  $array   Array we're going to search
	 * @param   string $path    Array path
	 * @param   mixed  $default Default return value
	 * @return  mixed
	 */
	public static function get(array $array, $path, $default = null)
	{
		$segments = explode('.', $path);

		foreach ($segments as $segment) {
			if (! is_array($array) or ! isset($array[$segment])) {
				return $default;
			}

			$array = $array[$segment];
		}

		return $array;
	}

	/**
	 * remove an array value using "dot notation".
	 *
	 * @param   array  $array Array you want to modify
	 * @param   string $path  Array path
	 * @return  boolean
	 */
	public static function remove(array &$array, $path)
	{
		$segments = explode('.', $path);

		while (count($segments) > 1) {
			$segment = array_shift($segments);

			if (! isset($array[$segment]) or ! is_array($array[$segment])) {
				return false;
			}

			$array =& $array[$segment];
		}

		unset($array[array_shift($segments)]);

		return true;
	}

	/**
	 * Returns a random value from an array.
	 *
	 * @param   array $array Array you want to pick a random value from
	 * @return  mixed
	 */
	public static function random(array $array)
	{
		return $array[array_rand($array)];
	}

	/**
	 * Returns TRUE if the array is associative and FALSE if not.
	 *
	 * @param   array $array Array to check
	 * @return  boolean
	 */
	public static function isAssoc(array $array)
	{
		return count(array_filter(array_keys($array), 'is_string')) === count($array);
	}
}