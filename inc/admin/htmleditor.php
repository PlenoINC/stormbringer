<?php
/**
 * HTML editor
 *
 * Customize HTML editor buttons and styles
 *
 * @package StormBringer
 */

/**
 * HTML editor: use theme css in editor
 */
add_editor_style( 'css/styles.css' );


/**
 * HTML editor: styles
 *
 * @param $settings
 *
 * @return mixed
 */
function stormbringer_htmleditor_styles( $settings ) {

	$style_formats = array(

		array(
			'title'   => __('Lead', 'stormbringer'),
			'block'   => 'p',
			'classes' => 'lead',
		),
		array(
			'title'   => __('Small', 'stormbringer'),
			'inline'   => 'small',
		),
		array(
			'title'   => __('Muted', 'stormbringer'),
			'block'   => 'p',
			'classes' => 'text-muted',
		),
		array(
			'title'   => __('Alert Danger', 'stormbringer'),
			'block'   => 'div',
			'classes' => 'alert alert-danger',
			'wrapper' => true
		),
		array(
			'title'   => __('Alert Success', 'stormbringer'),
			'block'   => 'div',
			'classes' => 'alert alert-success',
			'wrapper' => true
		),
		array(
			'title'   => __('Alert Warning', 'stormbringer'),
			'block'   => 'div',
			'classes' => 'alert alert-warning',
			'wrapper' => true
		),
		array(
			'title'   => __('Alert Info', 'stormbringer'),
			'block'   => 'div',
			'classes' => 'alert alert-info',
			'wrapper' => true
		),
		array(
			'title'    => __('Button', 'stormbringer'),
			'selector' => 'a',
			'classes'  => 'btn',
		),
		array(
			'title'    => __('Button Default', 'stormbringer'),
			'selector' => 'a',
			'classes'  => 'btn btn-default',
		),
		array(
			'title'    => __('Button Primary', 'stormbringer'),
			'selector' => 'a',
			'classes'  => 'btn btn-primary',
		),

	);

	$settings['style_formats'] = json_encode( $style_formats );

	return $settings;

}
add_filter( 'tiny_mce_before_init', 'stormbringer_htmleditor_styles' );

/**
 * HTML editor: buttons, line 1
 *
 * @param $buttons
 *
 * @return array
 */
function stormbringer_htmleditor_buttons_1( $buttons ) {
	return array(
        'formatselect',

		'bold',
		'italic',

        'bullist',
        'numlist',
        'blockquote',

        'alignleft',
        'aligncenter',
        'alignright',

        'link',
        'unlink',

        'wp_more',
		'wp_adv'
	);
}
add_filter( "mce_buttons", "stormbringer_htmleditor_buttons_1", 0 );

/**
 * HTML editor: buttons, line 2
 *
 * @param $buttons
 *
 * @return array
 */
function stormbringer_htmleditor_buttons_2( $buttons ) {
	return array(
        'styleselect',
        'strikethrough',
        'hr',
		'pastetext',
		'pasteword',
		'removeformat',
		'charmap',
		'outdent',
		'indent',
		'wp-help',
	);
}
add_filter( "mce_buttons_2", "stormbringer_htmleditor_buttons_2", 0 );