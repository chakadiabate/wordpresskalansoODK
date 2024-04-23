<?php

namespace Aepro\Modules\AcfFields\Skins;

use Aepro\Modules\AcfFields;
use Aepro\Classes\AcfMaster;
use Elementor\Group_Control_Box_Shadow;
use Aepro\Base\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;


class Skin_Radio extends Skin_Select {

	public function get_id() {
		return 'radio';
	}

	public function get_title() {
		return __( 'Radio', 'ae-pro' );
	}
	//phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
	protected function _register_controls_actions() {
		//phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
		parent::_register_controls_actions();
		remove_action( 'elementor/element/ae-acf/select_general-style/after_section_end', [ $this, 'register_fallback_style' ] );
		add_action( 'elementor/element/ae-acf/radio_general-style/after_section_end', [ $this, 'register_fallback_style' ] );
	}


	public function register_controls( Widget_Base $widget ) {

		$this->parent = $widget;

		parent::register_select_controls();
	}

}
