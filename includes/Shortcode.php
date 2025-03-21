<?php

namespace UTN\BiteEmbed;
use UTN\BiteEmbed\Helper;

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
			'data' => '',
		], $atts);
		wp_enqueue_script('utn-bite-embed');

		$data = sanitize_text_field($atts['data']);

		$jsonPath = plugin_dir_path(__DIR__) . 'src/data-sources/bite-sources.json';
		if (!file_exists($jsonPath)) {
			return '';
		}

		$jsonContent = file_get_contents($jsonPath);
		$biteSources = json_decode($jsonContent, true);

		if (!is_array($biteSources) || !isset($biteSources['de']) || !isset($biteSources['en'])) {
			return '';
		}

		$allowedValues = array_merge($biteSources['de'], $biteSources['en']);

		if (in_array($data, $allowedValues, true)) {
			return "<div class=\"jobWrapper-block\" data-bite-jobs-api-listing=\"{$data}\"></div>";
		}

		return "<div class=\"jobWrapper-block\" data-bite-jobs-api-listing=\"technische-uni-nuernberg:main-listing-de\"></div>";
	}

}
