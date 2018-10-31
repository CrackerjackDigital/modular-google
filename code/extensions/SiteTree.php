<?php
namespace Modular\Extensions\Model;

use FieldList;
use Modular\Interfaces\GACode;
use Modular\Modules\GoogleAnalytics;
use TextField;

class GoogleAnalyticsSiteTree extends \DataExtension implements GACode {
	const FieldName = 'GoogleAnalyticsCode';

	private static $db = [
		self::FieldName => 'Varchar(32)'
	];

	public function getGACode() {
		return GoogleAnalytics::enabled() ? ($this->owner->{self::FieldName} ?: \SiteConfig::current_site_config()->getGACode()) : '';
	}

	/**
	 * @param \FieldList $fields
	 */
	public function updateCMSFields( FieldList $fields ) {
		parent::updateCMSFields( $fields );
		$fields->addFieldToTab(
			'Root.Google',
			TextField::create(
				self::FieldName,
				_t( 'GoogleAnalytics.Field.Label', 'Google Analytics Code' )
			)->setAttribute( 'placeholder', GoogleAnalytics::google_analytics_code() )
		);
	}

}