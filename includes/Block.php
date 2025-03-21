<?php

namespace UTN\BiteEmbed;

use RRZE\Bluesky\Render;

class Block
{
	public function __construct()
	{
		add_action('init', [$this, 'utn_register_blocks_and_translations']);
	}

	/**
	 * Registers blocks and localizations.
	 */
	public function utn_register_blocks_and_translations()
	{
		register_block_type(plugin_dir_path(__DIR__) . 'build/utn-bite-embed', [
			'render_callback' => [Shortcode::class, 'renderShortcode'],
		]);

		$script_handle = generate_block_asset_handle('rrze-bite-embed', 'editorScript');
		wp_set_script_translations($script_handle, 'rrze-bite-embed', plugin_dir_path(__DIR__) . 'languages');
		load_plugin_textdomain('rrze-bite-embed', false, dirname(plugin_basename(__DIR__)) . '/languages');
	}


}
