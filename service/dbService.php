<?php

namespace App\Service;

use Exception;
use mysqli;

class DBSession
{
	private static ?mysqli $connection = null;

	private static function createDBConnection(): void
	{
		if (self::$connection !== null)
		{
			return;
		}

		$db_host = option('DB_HOST');
		$username = option('DB_USERNAME');
		$password = option('DB_PASSWORD');
		$db_name = option('DB_NAME');

		self::$connection = mysqli_init();

		$connection_result = mysqli_real_connect(
			self::$connection,
			$db_host,
			$username,
			$password,
			$db_name
		);

		if (!$connection_result)
		{
			$error = mysqli_connect_errno() . ': ' . mysqli_connect_error();
			throw new Exception($error);
		}

		$encoding_result = mysqli_set_charset(self::$connection, 'utf8');

		if (!$encoding_result)
		{
			throw new Exception(mysqli_error(self::$connection));
		}

	}

	public static function requestDB(
		string $query,
		string $rowOfTypes = '',
		array  $vars = [],
	): \mysqli_result|bool
	{
		if (!isset(self::$connection))
		{
			self::createDBConnection();
		}

		if ($rowOfTypes)
		{
			$statement = mysqli_prepare(self::$connection, $query);

			if (is_bool($statement))
			{
				throw new Exception(mysqli_error(self::$connection));
			}

			mysqli_stmt_bind_param($statement, $rowOfTypes, ...$vars);
			$execute_result = mysqli_stmt_execute($statement);

			if (!$execute_result)
			{
				throw new Exception(mysqli_error(self::$connection));
			}

			$result = mysqli_stmt_get_result($statement);
		}
		else
		{
			$result = mysqli_query(self::$connection, $query);
		}

		return $result;
	}
}
