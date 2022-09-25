<?php
/**
 * @author  AddonMonster
 * @since   1.0
 * @version 1.0
 */

namespace addonmonster\Ogo_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Base;
use Elementor\Core\Schemes\Typography as Scheme_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit;

class Amt_Faq_Section extends Custom_Widget_Base {

    public function __construct( $data = [], $args = null ){
        $this->amt_name = esc_html__( 'AMT FAQ ', 'ogo-core' );
        $this->amt_base = 'amt-faq-section';
        parent::__construct( $data, $args );
    }

    public function amt_fields(){
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'selected_icon',
            [
                'label' => esc_html__( 'Icon', 'ogo-core' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check-circle',
                    'library' => 'fa-solid',
                ],
                'fa4compatibility' => 'icon',
            ]
        );
        $repeater->add_control(
            'tab_title',
            [
                'label' => esc_html__( 'Tab Title', 'ogo-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__( 'Tab Title', 'ogo-core' ),
                'default' => esc_html__( 'Tab Title', 'ogo-core' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater_2 = new \Elementor\Repeater();
        $repeater_2->add_control(
            'tab_title',
            [
                'label' => esc_html__( 'Tab Title', 'ogo-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__( 'Tab Title', 'ogo-core' ),
                'default' => esc_html__( 'Tab Title', 'ogo-core' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'tab_repeater_2',
            [

                'label' => esc_html__( 'Inside Tab Items', 'ogo-core' ),
                'id'    =>'tabs',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater_2->get_controls(),
                'default' => [
                    [
                        'tab_title' => esc_html__( 'Inside item', 'ogo-core' ),
                        'selected_icon' => [
                            'value' => 'fas fa-check-circle',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
                'title_field' => '{{{ tab_title}}}',
            ]
        );

        $fields = array(
            array(
                'mode'    => 'section_start',
                'id'      => 'sec_general',
                'label'   => esc_html__( 'General', 'ogo-core' ),
            ),
            array (
                'label' => esc_html__( 'Tab Items', 'ogo-core' ),
                'id'    =>'tabs',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tab_title' => esc_html__( 'Tab Item 1', 'ogo-core' ),
                        'selected_icon' => [
                            'value' => 'fas fa-check-circle',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
                'title_field' => '{{{ tab_title}}}',
            ),

            array(
                'mode' => 'section_end',
            ),
            // Style
            array(
                'mode'    => 'section_start',
                'id'      => 'sec_style',
                'label'   => esc_html__( 'Style', 'ogo-core' ),
                'tab'     => Controls_Manager::TAB_STYLE,
            ),
            array (
                'mode'    => 'group',
                'type'    => Group_Control_Typography::get_type(),
                'name'    => 'title_typo',
                'label'   => esc_html__( 'Title Style', 'ogo-core' ),
                'selector' => '{{WRAPPER}} ',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
            ),

            array(
                'mode' => 'section_end',
            ),
        );
        return $fields;
    }

    protected function render() {
        $data = $this->get_settings();

        $this->amt_template( 'faq-section', $data );
    }
}