<?php
/**
 * Rsimple Sample 
 */

require_once('framework.php');

$sample_sections[] = array(
	'title' => 'General Fields',
	'heading' => 'Fields Content',
	'icon' => 'fa-bars',
	'fields' => array(
		array(
			'title' => 'Text',
			'subtitle' => 'Default form text fields',
			'desc' => 'Description always good for additional information.',
			'id' => 'opt-text',
			'type' => 'text'
			),
		array(
			'title' => 'Text with placeholder',
			'subtitle' => 'Default form text fields',
			'desc' => 'Description always good for additional information.',
			'placeholder' => 'This is placeholder for text',
			'id' => 'opt-text',
			'type' => 'text'
			),
		array(
			'title' => 'Textarea',
			'subtitle' => 'Default Textarea',
			'desc' => 'Again Description always good for additional information.',
			'id' => 'opt-textarea',
			'type' => 'textarea'
			),
		array(
			'title' => 'Switch',
			'subtitle' => 'Button with On Off',
			'desc' => 'Again Description always good for additional information.',
			'id' => 'opt-switch',
			'type' => 'switch',
			'default' => true
			),
		array(
			'title' => 'Select',
			'subtitle' => 'Select field with search',
			'desc' => 'Again Description always good for additional information.',
			'id' => 'opt-select',
			'type' => 'select',
			'options' => array(
				'value-1' => 'Select Content 1',
				'value-2' => 'Select Content 2',
				'value-3' => 'Select Content 3',
				'value-4' => 'Select Content 4',
				'value-5' => 'Select Content 5',
				'value-6' => 'Select Content 6',
				),
			'default' => 'value-5'
			),
		array(
			'title' => 'Ace Editor',
			'subtitle' => 'Need script editor? you can use this ace editor',
			'desc' => 'You can set for html, css, javascript, php, perl etc',			
			'id' => 'opt-aceeditor',
			'type' => 'ace_editor',
			'mode' => 'text',
			),
		array(
			'title' => 'Multi Text',
			'subtitle' => 'Add many text you want.',			
			'id' => 'opt-multitext',
			'type' => 'multi_text'
			),
		)
	);

$sample_sections[] = array(
	'title' => 'Checkbox Fields',
	'heading' => 'Checkbox',
	'icon' => 'fa-check-square',
	'fields' => array(
			array(
				'title' => 'Checkbox',
				'subtitle' => 'Default checkbox with style',
				'desc' => 'Description always good for additional information.',
				'id' =>  'opt-checkbox',
				'type' => 'checkbox',
				'options' => array(
					'value-1' => 'Checkbox Title 1',
					'value-2' => 'Checkbox Title 2',
					'value-3' => 'Checkbox Title 3',
					'value-4' => 'Checkbox Title 4'
					),
				'default' => 'value-1'
				),
		)
	);
$sample_sections[] = array(
	'title' => 'Radio Fields',
	'heading' => 'Radio',
	'icon' => 'fa-dot-circle-o',
	'fields' => array(
			array(
				'title' => 'Radio',
				'subtitle' => 'Default radio',
				'desc' => 'Description always good for additional information.',
				'id' => 'opt-radio',
				'type' => 'radio',
				'options' => array(	
					'value-1' => 'Radio content 1',
					'value-2' => 'Radio content 2',
					'value-3' => 'Radio content 3',
					'value-4' => 'Radio content 4',
					),
				'default' => 'value-1'
				),
			array(
				'title' => 'Image select',
				'subtitle' => 'Image selection base on radio field',
				'desc' => 'You can use your own image for selection',
				'id' => 'opt-imageselect',
				'type' => 'image_select',
				'options' => array(
					'value-1' => array( 'img' => rsimple_framework::$__url .'/assets/img/column1.png', 'alt' => 'Column 1'),
					'value-2' => array( 'img' => rsimple_framework::$__url .'/assets/img/column2.png', 'alt' => 'Column 2'),
					'value-3' => array( 'img' => rsimple_framework::$__url .'/assets/img/column3.png', 'alt' => 'Column 3'),
					'value-4' => array( 'img' => rsimple_framework::$__url .'/assets/img/column4.png', 'alt' => 'Column 4'),
					'value-5' => array( 'img' => rsimple_framework::$__url .'/assets/img/column5.png', 'alt' => 'Column 5'),
					),
				'default' => 'value-4'
				),
		)
	);
$sample_sections[] = array(
	'title' => 'Media fields',
	'heading' => 'Media',
	'icon' => 'fa-photo',
	'fields' => array(
		array(
			'title' => 'Media Upload',
			'subtitle' => 'Select/Upload single image.',
			'desc' => 'This feature just select single image.',
			'id' => 'opt-media',
			'type' => 'media',
			),
		array(
			'title' => 'Social Media',
			'subtitle' => 'Use this for add social media account',			
			'id' => 'opt-socialmedia',
			'type' => 'socialmedia'
			),
		)
	);

$sample_args = array(
	'option_name' => 'sample_options',
	'display_name' => 'Sample Options',
	'display_version' => '1.1',
	'page_slug' => 'rsimple_options',
	'menu_type' => 'menu',
	'menu_title' => 'Rsimple Options',
	'menu_icon' => 'fa-dekstop',
	'page_parent' => '',

	'sections' => $sample_sections,
	);

$sample_panel = new rsimple_framework($sample_args);

