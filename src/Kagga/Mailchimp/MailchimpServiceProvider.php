<?php

namespace Kagga\Mailchimp;

use Illuminate\Support\ServiceProvider;
use NZTim\Mailchimp\DrewMMailchimp;

class MailchimpServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(MailChimp::class, function() {
			return new MailChimp(new DrewMMailchimp(env('MAILCHIMP_KEY')));
		});
	}

}
