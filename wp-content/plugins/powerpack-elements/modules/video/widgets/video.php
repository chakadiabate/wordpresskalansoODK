<?php
namespace PowerpackElements\Modules\Video\Widgets;

use PowerpackElements\Base\Powerpack_Widget;
use PowerpackElements\Modules\Video\Module;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Embed;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Video Widget
 */
class Video extends Powerpack_Widget {

	/**
	 * Retrieve video widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return parent::get_widget_name( 'Video' );
	}

	/**
	 * Retrieve video widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return parent::get_widget_title( 'Video' );
	}

	/**
	 * Retrieve the list of categories the video widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return parent::get_widget_categories( 'Video' );
	}

	/**
	 * Retrieve video widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return parent::get_widget_icon( 'Video' );
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return parent::get_widget_keywords( 'Video' );
	}

	/**
	 * Retrieve the list of scripts the video widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return array(
			'fancybox',
			'powerpack-frontend',
		);
	}

	/**
	 * Register video widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 2.0.3
	 * @access protected
	 */
	protected function register_controls() {

		/*-----------------------------------------------------------------------------------*/
		/*	CONTENT TAB
		/*-----------------------------------------------------------------------------------*/

		/**
		 * Content Tab: Video
		 */
		$this->start_controls_section(
			'section_video',
			array(
				'label' => __( 'Video', 'powerpack' ),
			)
		);

		$this->add_control(
			'video_source',
			array(
				'label'   => __( 'Source', 'powerpack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'youtube',
				'options' => array(
					'youtube'     => __( 'YouTube', 'powerpack' ),
					'vimeo'       => __( 'Vimeo', 'powerpack' ),
					'dailymotion' => __( 'Dailymotion', 'powerpack' ),
					'hosted'      => __( 'Self Hosted', 'powerpack' ),
				),
			)
		);

		$this->add_control(
			'youtube_url',
			array(
				'label'       => __( 'URL', 'powerpack' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active'     => true,
					'categories' => array(
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					),
				),
				'placeholder' => __( 'Enter your YouTube URL', 'powerpack' ),
				'default'     => 'https://www.youtube.com/watch?v=XHOmBV4js_E',
				'label_block' => true,
				'ai'          => [
					'active' => false,
				],
				'condition'   => array(
					'video_source' => 'youtube',
				),
			)
		);

		$this->add_control(
			'vimeo_url',
			array(
				'label'       => __( 'URL', 'powerpack' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active'     => true,
					'categories' => array(
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					),
				),
				'placeholder' => __( 'Enter your Vimeo URL', 'powerpack' ),
				'default'     => 'https://vimeo.com/235215203',
				'label_block' => true,
				'ai'          => [
					'active' => false,
				],
				'condition'   => array(
					'video_source' => 'vimeo',
				),
			)
		);

		$this->add_control(
			'dailymotion_url',
			array(
				'label'       => __( 'URL', 'powerpack' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active'     => true,
					'categories' => array(
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					),
				),
				'placeholder' => __( 'Enter your Dailymotion URL', 'powerpack' ),
				'default'     => 'https://www.dailymotion.com/video/x6tqhqb',
				'label_block' => true,
				'ai'          => [
					'active' => false,
				],
				'condition'   => array(
					'video_source' => 'dailymotion',
				),
			)
		);

		$this->add_control(
			'insert_url',
			[
				'label'     => __( 'External URL', 'powerpack' ),
				'type'      => Controls_Manager::SWITCHER,
				'ai'        => [
					'active' => false,
				],
				'condition' => [
					'video_source' => 'hosted',
				],
			]
		);

		$this->add_control(
			'hosted_url',
			[
				'label'      => __( 'Choose File', 'powerpack' ),
				'type'       => Controls_Manager::MEDIA,
				'dynamic'    => [
					'active' => true,
					'categories' => [
						TagsModule::MEDIA_CATEGORY,
					],
				],
				'media_type' => 'video',
				'ai'         => [
					'active' => false,
				],
				'condition'  => [
					'video_source' => 'hosted',
					'insert_url'   => '',
				],
			]
		);

		$this->add_control(
			'external_url',
			[
				'label'        => __( 'URL', 'powerpack' ),
				'type'         => Controls_Manager::URL,
				'autocomplete' => false,
				'options'      => false,
				'label_block'  => true,
				'show_label'   => false,
				'dynamic'      => [
					'active' => true,
					'categories' => [
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					],
				],
				'media_type'   => 'video',
				'placeholder'  => __( 'Enter your URL', 'powerpack' ),
				'ai'           => [
					'active' => false,
				],
				'condition'    => [
					'video_source' => 'hosted',
					'insert_url'   => 'yes',
				],
			]
		);

		$this->add_control(
			'start_time',
			array(
				'label'       => __( 'Start Time', 'powerpack' ),
				'type'        => Controls_Manager::NUMBER,
				'description' => __( 'Enter start time in seconds', 'powerpack' ),
				'condition'   => array(
					'loop' => '',
				),
			)
		);

		$this->add_control(
			'end_time',
			array(
				'label'       => __( 'End Time', 'powerpack' ),
				'type'        => Controls_Manager::NUMBER,
				'description' => __( 'Enter end time in seconds', 'powerpack' ),
				'condition'   => array(
					'loop'         => '',
					'video_source' => array( 'youtube', 'hosted' ),
				),
			)
		);

		$this->add_control(
			'aspect_ratio',
			array(
				'label'              => __( 'Aspect Ratio', 'powerpack' ),
				'type'               => Controls_Manager::SELECT,
				'options'            => array(
					'169' => '16:9',
					'219' => '21:9',
					'916' => '9:16',
					'43'  => '4:3',
					'32'  => '3:2',
					'11'  => '1:1',
				),
				'default'            => '169',
				'prefix_class'       => 'elementor-aspect-ratio-',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'video_options',
			array(
				'label'     => __( 'Video Options', 'powerpack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'preload',
			array(
				'label'     => __( 'Preload', 'powerpack' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'auto'     => 'Auto',
					'metadata' => 'Meta data',
					'none'     => 'None',
				),
				'default'   => 'auto',
				'condition' => array(
					'video_source' => 'hosted',
				),
			)
		);

		$this->add_control(
			'lightbox',
			array(
				'label' => __( 'Lightbox', 'powerpack' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label'              => __( 'Autoplay', 'powerpack' ),
				'type'               => Controls_Manager::SWITCHER,
				'default'            => '',
				'label_on'           => __( 'Yes', 'powerpack' ),
				'label_off'          => __( 'No', 'powerpack' ),
				'return_value'       => 'yes',
				'frontend_available' => true,
				'condition'          => [
					'lightbox!' => 'yes',
				],
			)
		);

		$this->add_control(
			'play_on_mobile',
			array(
				'label'     => __( 'Play On Mobile', 'powerpack' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'autoplay' => 'yes',
				],
			)
		);

		$this->add_control(
			'mute',
			array(
				'label'              => __( 'Mute', 'powerpack' ),
				'type'               => Controls_Manager::SWITCHER,
				'default'            => '',
				'label_on'           => __( 'Yes', 'powerpack' ),
				'label_off'          => __( 'No', 'powerpack' ),
				'return_value'       => 'yes',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'loop',
			array(
				'label'     => __( 'Loop', 'powerpack' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => array(
					'video_source!' => 'dailymotion',
				),
			)
		);

		$this->add_control(
			'controls',
			array(
				'label'     => __( 'Player Controls', 'powerpack' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'powerpack' ),
				'label_on'  => __( 'Show', 'powerpack' ),
				'default'   => 'yes',
				'condition' => array(
					'video_source!' => 'vimeo',
				),
			)
		);

		$this->add_control(
			'color',
			array(
				'label'     => __( 'Controls Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => array(
					'video_source' => array( 'vimeo', 'dailymotion' ),
				),
			)
		);

		$this->add_control(
			'modestbranding',
			array(
				'label'       => __( 'Modest Branding', 'powerpack' ),
				'description' => __( 'Turn on this option to use a YouTube player that does not show a YouTube logo.', 'powerpack' ),
				'type'        => Controls_Manager::SWITCHER,
				'condition'   => array(
					'video_source' => array( 'youtube' ),
					'controls'     => 'yes',
				),
			)
		);

		$this->add_control(
			'yt_privacy',
			array(
				'label'       => __( 'Privacy Mode', 'powerpack' ),
				'type'        => Controls_Manager::SWITCHER,
				'description' => __( 'When you turn on privacy mode, YouTube won\'t store information about visitors on your website unless they play the video.', 'powerpack' ),
				'condition'   => array(
					'video_source' => 'youtube',
				),
			)
		);

		$this->add_control(
			'rel',
			array(
				'label'     => __( 'Suggested Videos', 'powerpack' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''    => __( 'Current Video Channel', 'powerpack' ),
					'yes' => __( 'Any Video', 'powerpack' ),
				),
				'condition' => array(
					'video_source' => 'youtube',
				),
			)
		);

		// Dailymotion
		$this->add_control(
			'showinfo',
			array(
				'label'     => __( 'Video Info', 'powerpack' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'powerpack' ),
				'label_on'  => __( 'Show', 'powerpack' ),
				'default'   => 'yes',
				'condition' => array(
					'video_source' => array( 'dailymotion' ),
				),
			)
		);

		$this->add_control(
			'logo',
			array(
				'label'     => __( 'Logo', 'powerpack' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'powerpack' ),
				'label_on'  => __( 'Show', 'powerpack' ),
				'default'   => 'yes',
				'condition' => array(
					'video_source' => array( 'dailymotion' ),
				),
			)
		);

		// Vimeo.
		$this->add_control(
			'vimeo_title',
			array(
				'label'     => __( 'Intro Title', 'powerpack' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'powerpack' ),
				'label_on'  => __( 'Show', 'powerpack' ),
				'default'   => 'yes',
				'condition' => array(
					'video_source' => 'vimeo',
				),
			)
		);

		$this->add_control(
			'vimeo_portrait',
			array(
				'label'     => __( 'Intro Portrait', 'powerpack' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'powerpack' ),
				'label_on'  => __( 'Show', 'powerpack' ),
				'default'   => 'yes',
				'condition' => array(
					'video_source' => 'vimeo',
				),
			)
		);

		$this->add_control(
			'vimeo_byline',
			array(
				'label'     => __( 'Intro Byline', 'powerpack' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'powerpack' ),
				'label_on'  => __( 'Show', 'powerpack' ),
				'default'   => 'yes',
				'condition' => array(
					'video_source' => 'vimeo',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Content Tab: Thumbnail
		 */
		$this->start_controls_section(
			'section_thumbnail',
			array(
				'label' => __( 'Thumbnail', 'powerpack' ),
			)
		);

		$this->add_control(
			'thumbnail_size',
			array(
				'label'     => __( 'Thumbnail Size', 'powerpack' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'maxresdefault',
				'options'   => array(
					'maxresdefault' => __( 'Maximum Resolution', 'powerpack' ),
					'hqdefault'     => __( 'High Quality', 'powerpack' ),
					'mqdefault'     => __( 'Medium Quality', 'powerpack' ),
					'sddefault'     => __( 'Standard Quality', 'powerpack' ),
				),
				'condition' => array(
					'video_source' => 'youtube',
				),
			)
		);

		$this->add_control(
			'custom_thumbnail',
			array(
				'label'   => __( 'Custom Thumbnail', 'powerpack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
			)
		);

		$this->add_control(
			'custom_image',
			array(
				'label'     => __( 'Image', 'powerpack' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'custom_thumbnail' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Content Tab: Play Icon
		 */
		$this->start_controls_section(
			'section_play_icon_settings',
			array(
				'label' => __( 'Play Icon', 'powerpack' ),
			)
		);

		$this->add_control(
			'play_icon_type',
			array(
				'label'       => __( 'Icon Type', 'powerpack' ),
				'label_block' => false,
				'toggle'      => false,
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'none'  => array(
						'title' => esc_html__( 'None', 'powerpack' ),
						'icon'  => 'eicon-ban',
					),
					'icon'  => array(
						'title' => esc_html__( 'Icon', 'powerpack' ),
						'icon'  => 'eicon-star',
					),
					'image' => array(
						'title' => esc_html__( 'Image', 'powerpack' ),
						'icon'  => 'eicon-image-bold',
					),
				),
				'default'     => 'icon',
			)
		);

		$this->add_control(
			'select_play_icon',
			array(
				'label'            => __( 'Select Icon', 'powerpack' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'play_icon',
				'default'          => array(
					'value'   => 'fas fa-play-circle',
					'library' => 'fa-solid',
				),
				'recommended'      => array(
					'fa-regular' => array(
						'play-circle',
					),
					'fa-solid'   => array(
						'play',
						'play-circle',
					),
				),
				'condition'        => array(
					'play_icon_type' => 'icon',
				),
			)
		);

		$this->add_control(
			'play_icon_image',
			array(
				'label'     => __( 'Select Image', 'powerpack' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'play_icon_type' => 'image',
				),
			)
		);

		$this->end_controls_section();

		/*-----------------------------------------------------------------------------------*/
		/* STYLE TAB
		/*-----------------------------------------------------------------------------------*/

		/**
		 * Style Tab: Overlay
		 */
		$this->start_controls_section(
			'section_overlay_style',
			array(
				'label' => __( 'Overlay', 'powerpack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'overlay_blend_mode',
			array(
				'label'     => __( 'Blend Mode', 'powerpack' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'normal',
				'options'   => array(
					'normal'      => __( 'Normal', 'powerpack' ),
					'multiply'    => __( 'Multiply', 'powerpack' ),
					'screen'      => __( 'Screen', 'powerpack' ),
					'overlay'     => __( 'Overlay', 'powerpack' ),
					'darken'      => __( 'Darken', 'powerpack' ),
					'lighten'     => __( 'Lighten', 'powerpack' ),
					'color-dodge' => __( 'Color Dodge', 'powerpack' ),
					'color'       => __( 'Color', 'powerpack' ),
					'hue'         => __( 'Hue', 'powerpack' ),
					'hard-light'  => __( 'Hard Light', 'powerpack' ),
					'soft-light'  => __( 'Soft Light', 'powerpack' ),
					'difference'  => __( 'Difference', 'powerpack' ),
					'exclusion'   => __( 'Exclusion', 'powerpack' ),
					'saturation'  => __( 'Saturation', 'powerpack' ),
					'luminosity'  => __( 'Luminosity', 'powerpack' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-video-overlay' => 'mix-blend-mode: {{VALUE}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_overlay_style' );

		$this->start_controls_tab(
			'tab_overlay_normal',
			array(
				'label' => __( 'Normal', 'powerpack' ),
			)
		);

		$this->add_control(
			'overlay_background_color_normal',
			array(
				'label'     => __( 'Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-video-overlay' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'overlay_margin_normal',
			array(
				'label'     => __( 'Margin', 'powerpack' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-video-overlay' => 'top: {{SIZE}}px; bottom: {{SIZE}}px; left: {{SIZE}}px; right: {{SIZE}}px;',
				),
			)
		);

		$this->add_control(
			'overlay_opacity_normal',
			array(
				'label'     => __( 'Opacity', 'powerpack' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-video-overlay' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_overlay_hover',
			array(
				'label' => __( 'Hover', 'powerpack' ),
			)
		);

		$this->add_control(
			'overlay_background_color_hover',
			array(
				'label'     => __( 'Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pp-video:hover .pp-video-overlay' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'overlay_margin_hover',
			array(
				'label'     => __( 'Margin', 'powerpack' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-video:hover .pp-video-overlay' => 'top: {{SIZE}}px; bottom: {{SIZE}}px; left: {{SIZE}}px; right: {{SIZE}}px;',
				),
			)
		);

		$this->add_control(
			'overlay_opacity_hover',
			array(
				'label'     => __( 'Opacity', 'powerpack' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-video:hover .pp-video-overlay' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Style Tab: Play Icon
		 */
		$this->start_controls_section(
			'section_play_icon_style',
			array(
				'label'     => __( 'Play Icon', 'powerpack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'play_icon_type!' => 'none',
				),
			)
		);

		$this->add_responsive_control(
			'play_icon_size',
			array(
				'label'     => __( 'Size', 'powerpack' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 10,
						'max' => 400,
					),
				),
				'default'   => array(
					'size' => 80,
					'unit' => 'px',
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-video-play-icon' => 'font-size: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'play_icon_type!' => 'none',
				),
			)
		);

		$this->add_control(
			'play_icon_border_radius',
			array(
				'label'      => __( 'Border Radius', 'powerpack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .pp-video-play-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'play_icon_type' => 'image',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_play_icon_style' );

		$this->start_controls_tab(
			'tab_play_icon_normal',
			array(
				'label'     => __( 'Normal', 'powerpack' ),
				'condition' => array(
					'play_icon_type'           => 'icon',
					'select_play_icon[value]!' => '',
				),
			)
		);

		$this->add_control(
			'play_icon_color',
			array(
				'label'     => __( 'Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pp-video-play-icon'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .pp-video-play-icon svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'play_icon_type'           => 'icon',
					'select_play_icon[value]!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'      => 'play_icon_text_shadow',
				'label'     => __( 'Shadow', 'powerpack' ),
				'selector'  => '{{WRAPPER}} .pp-video-play-icon',
				'condition' => array(
					'play_icon_type'           => 'icon',
					'select_play_icon[value]!' => '',
				),
			)
		);

		$this->add_control(
			'play_icon_opacity',
			array(
				'label'     => __( 'Opacity', 'powerpack' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-video-play-icon' => 'opacity: {{SIZE}}',
				),
				'condition' => array(
					'play_icon_type!' => 'none',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_play_icon_hover',
			array(
				'label'     => __( 'Hover', 'powerpack' ),
				'condition' => array(
					'play_icon_type'           => 'icon',
					'select_play_icon[value]!' => '',
				),
			)
		);

		$this->add_control(
			'play_icon_hover_color',
			array(
				'label'     => __( 'Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pp-video-container:hover .pp-video-play-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pp-video-container:hover .pp-video-play-icon svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'play_icon_type'           => 'icon',
					'select_play_icon[value]!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'      => 'play_icon_hover_text_shadow',
				'selector'  => '{{WRAPPER}} .pp-video-container:hover .pp-video-play-icon',
				'condition' => array(
					'play_icon_type'           => 'icon',
					'select_play_icon[value]!' => '',
				),
			)
		);

		$this->add_control(
			'play_icon_hover_opacity',
			array(
				'label'     => __( 'Opacity', 'powerpack' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .pp-video-container:hover .pp-video-play-icon' => 'opacity: {{SIZE}}',
				),
				'condition' => array(
					'play_icon_type!' => 'none',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Style Tab: Lightbox
		 */
		$this->start_controls_section(
			'section_lightbox_style',
			array(
				'label'     => __( 'Lightbox', 'powerpack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'lightbox' => 'yes',
				),
			)
		);

		$this->add_control(
			'lightbox_color',
			array(
				'label'     => __( 'Background Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'#elementor-lightbox-{{ID}}' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'lightbox' => 'yes',
				),
			)
		);

		$this->add_control(
			'lightbox_close_icon_color',
			array(
				'label'     => __( 'Close Icon Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'#elementor-lightbox-{{ID}} .dialog-lightbox-close-button' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'lightbox' => 'yes',
				),
			)
		);

		$this->add_control(
			'lightbox_close_icon_color_hover',
			array(
				'label'     => __( 'Close Icon Hover Color', 'powerpack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'#elementor-lightbox-{{ID}} .dialog-lightbox-close-button:hover' => 'color: {{VALUE}}',
				),
				'separator' => 'after',
				'condition' => array(
					'lightbox' => 'yes',
				),
			)
		);

		$this->add_control(
			'lightbox_video_width',
			array(
				'label'     => __( 'Content Width', 'powerpack' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
				),
				'range'     => array(
					'%' => array(
						'min' => 30,
					),
				),
				'selectors' => array(
					'(desktop+)#elementor-lightbox-{{ID}} .elementor-video-container' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'lightbox' => 'yes',
				),
			)
		);

		$this->add_control(
			'lightbox_content_position',
			array(
				'label'                => __( 'Content Position', 'powerpack' ),
				'type'                 => Controls_Manager::SELECT,
				'frontend_available'   => true,
				'options'              => array(
					''    => __( 'Center', 'powerpack' ),
					'top' => __( 'Top', 'powerpack' ),
				),
				'selectors'            => array(
					'#elementor-lightbox-{{ID}} .elementor-video-container' => '{{VALUE}}; transform: translateX(-50%);',
				),
				'selectors_dictionary' => array(
					'top' => 'top: 60px',
				),
				'condition'            => array(
					'lightbox' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'lightbox_content_animation',
			array(
				'label'              => __( 'Entrance Animation', 'powerpack' ),
				'type'               => Controls_Manager::ANIMATION,
				'frontend_available' => true,
				'condition'          => array(
					'lightbox' => 'yes',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$gallery_settings = array();

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			$gallery_settings['post_id'] = \Elementor\Plugin::$instance->editor->get_post_id();
		} else {
			$gallery_settings['post_id'] = get_the_ID();
		}

		$gallery_settings['widget_id'] = $this->get_id();

		$this->add_render_attribute(
			array(
				'video-wrap' => array(
					'class' => 'pp-video-wrap',
				),
				'video'      => array(
					'class'         => [ 'pp-video', 'pp-video-type-' . $settings['video_source'] ],
					'data-settings' => wp_json_encode( $gallery_settings ),
				),
			)
		);

		if ( 'hosted' === $settings['video_source'] ) {
			$video_url = $this->get_hosted_video_url();

			ob_start();

			$this->render_hosted_video();
			$video_html = ob_get_clean();
			$video_html = wp_json_encode( $video_html );
			$video_html = htmlspecialchars( $video_html, ENT_QUOTES );

			$this->add_render_attribute(
				'video',
				array(
					'data-hosted-html' => $video_html,
				)
			);
		}
		?>
		<div <?php $this->print_render_attribute_string( 'video-wrap' ); ?>>
			<div <?php $this->print_render_attribute_string( 'video' ); ?>>
				<?php $this->render_video(); ?>
			</div>
		</div>
		<?php
	}

	/**
	 * Render video widget as plain content.
	 *
	 * Override the default behavior, by printing the video URL insted of rendering it.
	 *
	 * @since 2.3.0
	 * @access public
	 */
	public function render_plain_content() {
		$settings = $this->get_settings_for_display();

		if ( 'hosted' !== $settings['video_source'] ) {
			$url = $settings[ $settings['video_source'] . '_url' ];
		} else {
			$url = $this->get_hosted_video_url();
		}

		echo esc_url( $url );
	}

	protected function render_video() {
		$settings = $this->get_settings_for_display();

		$video_url_src = '';
		$thumb_size    = '';
		if ( 'youtube' === $settings['video_source'] ) {
			$video_url_src = $settings['youtube_url'];
			$thumb_size    = $settings['thumbnail_size'];
		} elseif ( 'vimeo' === $settings['video_source'] ) {
			$video_url_src = $settings['vimeo_url'];
		} elseif ( 'dailymotion' === $settings['video_source'] ) {
			$video_url_src = $settings['dailymotion_url'];
		}

		$embed_params  = $this->get_embed_params();
		$embed_options = $this->get_embed_options();

		if ( 'hosted' === $settings['video_source'] ) {
			$video_url = $this->get_hosted_video_url();
		} else {
			if ( preg_match( '/youtube\.com\/shorts\/(\w+\s*\/?)*([0-9]+)*(.*)$/i', $video_url_src, $matches ) ) {
				$video_id = $matches[1];
				$video_url = $this->get_yt_short_embed_url( $video_id, $embed_params, $embed_options );
			} else {
				$video_url = Embed::get_embed_url( $video_url_src, $embed_params, $embed_options );
			}
		}

		$autoplay = ( 'yes' === $settings['autoplay'] ) ? '1' : '0';

		$this->add_render_attribute(
			array(
				'video-container' => array(
					'class' => array( 'pp-video-container', 'elementor-fit-aspect-ratio' ),
				),
				'video-play'      => array(
					'class' => 'pp-video-play',
				),
				'video-player'    => array(
					'class'    => 'pp-video-player',
					'data-src' => $video_url,
				),
			)
		);

		if ( 'yes' === $settings['lightbox'] ) {
			$lightbox_options = array(
				'type'         => 'video',
				'videoType'    => $settings['video_source'],
				'url'          => $video_url,
				'modalOptions' => array(
					'id'                       => 'elementor-lightbox-' . $this->get_id(),
					'entranceAnimation'        => $settings['lightbox_content_animation'],
					'entranceAnimation_tablet' => $settings['lightbox_content_animation_tablet'],
					'entranceAnimation_mobile' => $settings['lightbox_content_animation_mobile'],
					'videoAspectRatio'         => $settings['aspect_ratio'],
				),
			);

			if ( 'hosted' === $settings['video_source'] ) {
				$lightbox_options['videoParams'] = $this->get_hosted_params();
			}

			$this->add_render_attribute( 'video-play', 'class', 'pp-video-play-lightbox' );
			$this->add_render_attribute(
				'video-play',
				array(
					'data-elementor-open-lightbox' => 'yes',
					'data-elementor-lightbox'      => wp_json_encode( $lightbox_options ),
				)
			);

		} else {
			$this->add_render_attribute( 'video-play', 'data-autoplay', $autoplay );
		}
		if ( 'hosted' === $settings['video_source'] ) {
			$video_url = $this->get_hosted_video_url();
			$poster = '';

			if ( 'yes' === $settings['custom_thumbnail'] ) {
				if ( $settings['custom_image']['url'] ) {
					$poster = $settings['custom_image']['url'];
				}
			}

			$this->add_render_attribute(
				'hosted-video',
				array(
					'class'   => 'pp-hosted-video',
					'src'     => esc_url( $video_url ),
					'preload' => $settings['preload'],
					'poster'  => $poster,
				)
			);
		}
		?>
		<div <?php $this->print_render_attribute_string( 'video-container' ); ?>>
			<div <?php $this->print_render_attribute_string( 'video-play' ); ?>>
				<?php
					// Video Overlay
					echo wp_kses_post( $this->render_video_overlay() );
				?>
				<div <?php $this->print_render_attribute_string( 'video-player' ); ?>>
					<?php
						if ( 'hosted' === $settings['video_source'] ) {
							if ( 'yes' === $settings['custom_thumbnail'] ) {
								if ( $settings['custom_image']['url'] ) {
									$poster = $settings['custom_image']['url'];
								}
							}

							if ( $poster ) { ?>
								<img class="pp-video-thumb" src="<?php echo esc_url( $poster ); ?>" alt="">
							<?php } else { ?>
								<video <?php $this->print_render_attribute_string( 'hosted-video' ); ?>></video>
							<?php }
						} else {
							$video_thumb = $this->get_video_thumbnail( $thumb_size );

							if ( $video_thumb ) { ?>
								<img class="pp-video-thumb" src="<?php echo esc_url( $video_thumb ); ?>" alt="">
								<?php
							}
						}

						$this->render_play_icon();
					?>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Render youtube short embed URL.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	private function get_yt_short_embed_url( $video_id, $embed_params, $embed_options ) {
		if ( 'yes' === $embed_options['privacy'] ) {
			$yt_url = 'https://www.youtube-nocookie.com/embed/' . $video_id;
		} else {
			$yt_url = 'https://www.youtube.com/embed/' . $video_id;
		}
		return add_query_arg( $embed_params, $yt_url );
	}

	/**
	 * Render hosted video.
	 *
	 * @since 2.3.0
	 * @access protected
	 */
	private function render_hosted_video() {
		$video_url = $this->get_hosted_video_url();
		if ( empty( $video_url ) ) {
			return;
		}

		$video_params = $this->get_hosted_params();
		?>
		<video class="pp-hosted-video" src="<?php echo esc_url( $video_url ); ?>" <?php echo esc_attr( Utils::render_html_attributes( $video_params ) ); ?>></video>
		<?php
	}

	/**
	 * Returns Video Thumbnail.
	 *
	 * @access protected
	 */
	protected function get_video_thumbnail( $thumb_size ) {
		$settings = $this->get_settings_for_display();

		$thumb_url = '';
		$video_id  = $this->get_video_id();

		if ( 'yes' === $settings['custom_thumbnail'] ) {
			if ( $settings['custom_image']['url'] ) {
				$thumb_url = $settings['custom_image']['url'];
			}
		} elseif ( 'youtube' === $settings['video_source'] ) {
			if ( $video_id ) {
				$thumb_url = 'https://i.ytimg.com/vi/' . $video_id . '/' . $thumb_size . '.jpg';
			}
		} elseif ( 'vimeo' === $settings['video_source'] ) {
			if ( $video_id ) {
				$response = wp_remote_get( "https://vimeo.com/api/v2/video/$video_id.php" );

				if ( is_wp_error( $response ) ) {
					return;
				}

				$vimeo = maybe_unserialize( $response['body'] );
				$thumb_url = ( isset( $vimeo[0]['thumbnail_large'] ) && ! empty( $vimeo[0]['thumbnail_large'] ) ) ? str_replace( '_640', '_840', $vimeo[0]['thumbnail_large'] ) : '';
			}
		} elseif ( 'dailymotion' === $settings['video_source'] ) {
			if ( $video_id ) {
				$response = wp_remote_get( 'https://api.dailymotion.com/video/' . $video_id . '?fields=thumbnail_url' );

				if ( is_wp_error( $response ) ) {
					return;
				}
				$dailymotion = maybe_unserialize( $response['body'] );
				$get_thumbnail = json_decode( $dailymotion, true );
				$thumb_url     = $get_thumbnail['thumbnail_url'];
			}
		}

		return $thumb_url;
	}

	/**
	 * Returns Video ID.
	 *
	 * @access protected
	 */
	protected function get_video_id() {
		$settings = $this->get_settings_for_display();

		$video_id = '';

		if ( 'youtube' === $settings['video_source'] ) {
			$url = $settings['youtube_url'];

			if ( preg_match( '#(?<=v=|v\/|vi=|vi\/|youtu.be\/)[a-zA-Z0-9_-]{11}#', $url, $matches ) ) {
				$video_id = $matches[0];
			} else {
				if ( preg_match( '/youtube\.com\/shorts\/(\w+\s*\/?)*([0-9]+)*(.*)$/i', $url, $matches ) ) {
					$video_id = $matches[1];
				}
			}
		} elseif ( 'vimeo' === $settings['video_source'] ) {
			$url = $settings['vimeo_url'];

			$video_id = preg_replace( '/[^\/]+[^0-9]|(\/)/', '', rtrim( $url, '/' ) );

		} elseif ( 'dailymotion' === $settings['video_source'] ) {
			$url = $settings['dailymotion_url'];

			if ( preg_match( '/^.+dailymotion.com\/(?:video|swf\/video|embed\/video|hub|swf)\/([^&?]+)/', $url, $matches ) ) {
				$video_id = $matches[1];
			}
		}

		return $video_id;

	}

	/**
	 * @param bool $from_media
	 *
	 * @return string
	 * @since 2.2.7
	 * @access private
	 */
	protected function get_hosted_video_url() {
		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['insert_url'] ) ) {
			$video_url = $settings['external_url']['url'];
		} else {
			$video_url = $settings['hosted_url']['url'];
		}

		if ( empty( $video_url ) ) {
			return '';
		}

		if ( $settings['start_time'] || $settings['end_time'] ) {
			$video_url .= '#t=';
		}

		if ( $settings['start_time'] ) {
			$video_url .= $settings['start_time'];
		}

		if ( $settings['end_time'] ) {
			$video_url .= ',' . $settings['end_time'];
		}

		return $video_url;
	}

	/**
	 * @since 2.2.7
	 * @access private
	 */
	protected function get_hosted_params() {
		$settings = $this->get_settings_for_display();

		$video_params = [];

		foreach ( [ 'autoplay', 'loop', 'controls' ] as $option_name ) {
			if ( $settings[ $option_name ] ) {
				$video_params[ $option_name ] = '';
			}
		}

		$video_params['controlsList'] = 'nodownload';

		if ( $settings['mute'] ) {
			$video_params['muted'] = 'muted';
		}

		if ( $settings['play_on_mobile'] ) {
			$video_params['playsinline'] = '';
		}

		if ( 'yes' === $settings['custom_thumbnail'] ) {
			if ( $settings['custom_image']['url'] ) {
				$video_params['poster'] = $settings['custom_image']['url'];
			}
		}

		return $video_params;
	}

	/**
	 * Get embed params.
	 *
	 * Retrieve video widget embed parameters.
	 *
	 * @access public
	 *
	 * @return array Video embed parameters.
	 */
	public function get_embed_params() {
		$settings = $this->get_settings_for_display();

		$params = array();

		$params_dictionary = array();

		if ( 'youtube' === $settings['video_source'] ) {

			$params_dictionary = array(
				'loop',
				'mute',
				'controls',
				'modestbranding',
				'rel',
			);

			if ( $settings['loop'] ) {
				$video_properties = Embed::get_video_properties( $settings['youtube_url'] );

				$params['playlist'] = $video_properties['video_id'];
			}

			$params['autoplay'] = 1;

			if ( $settings['play_on_mobile'] ) {
				$params['playsinline'] = '1';
			}

			$params['wmode'] = 'opaque';

			$params['start'] = (int) $settings['start_time'];

			$params['end'] = (int) $settings['end_time'];
		} elseif ( 'vimeo' === $settings['video_source'] ) {

			$params_dictionary = array(
				'loop',
				'mute'           => 'muted',
				'vimeo_title'    => 'title',
				'vimeo_portrait' => 'portrait',
				'vimeo_byline'   => 'byline',
			);

			$params['color'] = str_replace( '#', '', $settings['color'] );

			$params['autopause'] = '0';
			$params['autoplay']  = '1';

			if ( $settings['play_on_mobile'] ) {
				$params['playsinline'] = '1';
			}
		} elseif ( 'dailymotion' === $settings['video_source'] ) {

			$params_dictionary = array(
				'controls',
				'mute',
				'showinfo' => 'ui-start-screen-info',
				'logo'     => 'ui-logo',
			);

			$params['ui-highlight'] = str_replace( '#', '', $settings['color'] );

			$params['start'] = (int) $settings['start_time'];

			$params['endscreen-enable'] = '0';
			$params['autoplay']         = 1;

			if ( $settings['play_on_mobile'] ) {
				$params['playsinline'] = '1';
			}
		}

		foreach ( $params_dictionary as $key => $param_name ) {
			$setting_name = $param_name;

			if ( is_string( $key ) ) {
				$setting_name = $key;
			}

			$setting_value = $settings[ $setting_name ] ? '1' : '0';

			$params[ $param_name ] = $setting_value;
		}

		return $params;
	}


	/**
	 * Get embed options.
	 *
	 * @access private
	 *
	 * @return array Video embed options.
	 */
	private function get_embed_options() {
		$settings = $this->get_settings_for_display();

		$embed_options = array();

		if ( 'youtube' === $settings['video_source'] ) {
			$embed_options['privacy'] = $settings['yt_privacy'];
		} elseif ( 'vimeo' === $settings['video_source'] ) {
			$embed_options['start'] = (int) $settings['start_time'];
		}

		// $embed_options['lazy_load'] = ! empty( $settings['lazy_load'] );

		return $embed_options;
	}

	protected function render_video_overlay() {
		$this->add_render_attribute(
			'overlay',
			'class',
			array(
				'pp-media-overlay',
				'pp-video-overlay',
			)
		);

		return '<div ' . $this->get_render_attribute_string( 'overlay' ) . '></div>';
	}

	/**
	 * Render play icon output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render_play_icon() {
		$settings = $this->get_settings_for_display();

		if ( 'none' === $settings['play_icon_type'] ) {
			return;
		}

		$this->add_render_attribute( 'play-icon', 'class', 'pp-video-play-icon' );

		if ( 'icon' === $settings['play_icon_type'] ) {
			$this->add_render_attribute( 'play-icon', 'class', 'pp-icon' );

			if ( ! isset( $settings['play_icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
				// add old default
				$settings['play_icon'] = 'fa fa-play-circle';
			}

			$has_icon = ! empty( $settings['play_icon'] );

			if ( $has_icon ) {
				$this->add_render_attribute( 'play-icon-i', 'class', $settings['play_icon'] );
				$this->add_render_attribute( 'play-icon-i', 'aria-hidden', 'true' );
			}

			if ( ! $has_icon && ! empty( $settings['select_play_icon']['value'] ) ) {
				$has_icon = true;
			}
			$migrated = isset( $settings['__fa4_migrated']['select_play_icon'] );
			$is_new   = ! isset( $settings['play_icon'] ) && Icons_Manager::is_migration_allowed();
			?>
			<span <?php $this->print_render_attribute_string( 'play-icon' ); ?>>
				<?php
				if ( $is_new || $migrated ) {
					Icons_Manager::render_icon( $settings['select_play_icon'], array( 'aria-hidden' => 'true' ) );
				} elseif ( ! empty( $settings['play_icon'] ) ) {
					?>
					<i <?php $this->print_render_attribute_string( 'play-icon-i' ); ?>></i>
					<?php
				}
				?>
			</span>
			<?php

		} elseif ( 'image' === $settings['play_icon_type'] ) {

			if ( $settings['play_icon_image']['url'] ) {
				?>
				<span <?php $this->print_render_attribute_string( 'play-icon' ); ?>>
					<img src="<?php echo esc_url( $settings['play_icon_image']['url'] ); ?>" alt="<?php echo esc_attr( Control_Media::get_image_alt( $settings['play_icon_image'] ) ); ?>">
				</span>
				<?php
			}
		}
	}
}
