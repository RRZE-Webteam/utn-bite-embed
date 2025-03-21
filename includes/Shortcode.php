<?php

namespace UTN\BiteEmbed;

class Shortcode
{
	public function __construct()
	{
		// Register the shortcode when this class is instantiated
		add_shortcode('utn-bite-embed', [$this, 'renderShortcode']);
	}

	/**
	 * Callback for the shortcode [utn-bite-embed data="string"].
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content BITE Data Selection
	 * @return string
	 */
	public static function renderShortcode($atts = [], $content = null)
	{
		$atts = shortcode_atts([
			'data' => ''
		], $atts);

		$data = sanitize_text_field($atts['data']);

		switch ($data) {
			case 'apple':
			case 'pie':
				return "<p>Hello {$data} world</p>";
			default:
				return "<p>Hello default world</p>";
		}
	}
}
