<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5f2708e5ac179',
	'title' => 'User Notification Settings',
	'fields' => array(
		array(
			'key' => 'field_5f270913ed38d',
			'label' => 'Should Notify User of New Content',
			'name' => 'should_notify_users',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;