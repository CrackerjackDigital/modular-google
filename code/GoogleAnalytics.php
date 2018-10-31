<?php
namespace Modular\Modules;

use Modular\Module;

class GoogleAnalytics extends Module {
	// set in app config to your code from ga
	private static $google_analytics_code = '';

	private static $permit_environments = [
		'dev' => false,
		'test' => true,
		'live' => true
	];

	private static $enabled = true;

	public static function google_analytics_code() {
		return static::enabled() ? static::config()->get('google_analytics_code') : '';
	}

	public static function enabled() {
		$permitted = static::config()->get('permit_environments') ?: [];
		$env = \Director::get_environment_type();
		return static::config()->get('enabled') && array_key_exists( $env, $permitted) && $permitted[$env];
	}
}