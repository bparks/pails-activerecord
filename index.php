<?php
require_once(__DIR__.'/ActiveRecord.php');

date_default_timezone_set('UTC');

function activerecord_config($app)
{
	if ($app->connection_strings() == null ||
		!is_array($app->connection_strings()) ||
		count($app->connection_strings()) == 0)
	{
		\Pails\Application::log('No connection strings set. Disabling activerecord support.');
	}
	else
	{
		\ActiveRecord\Config::initialize(function($cfg) use ($app)
		{
			$cfg->set_model_directory('models');

			$cfg->set_connections($app->connection_strings());
			$cfg->set_default_connection(\Pails\Application::environment());
		});
	}
}