<?php

namespace UTN\BiteEmbed;

class Main
{
	public function __construct()
	{
		new Block();
		new Shortcode();
		add_action('wp_enqueue_scripts', [$this, 'registerScripts']);
	}

	public function registerScripts()
	{
		wp_register_script(
			'utn-bite-embed',
			'https://static.b-ite.com/jobs-api/loader-v1/api-loader-v1.min.js',
			[],
			null,
			false
		);
	}
}
