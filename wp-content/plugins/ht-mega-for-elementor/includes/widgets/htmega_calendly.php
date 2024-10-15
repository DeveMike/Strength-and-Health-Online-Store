<?php
namespace Elementor;

// Elementor Classes
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class HTMega_Elementor_Widget_Calendly extends Widget_Base {

    public function get_name() {
        return 'htmega-calendly-addons';
    }
    
    public function get_title() {
        return __( 'Calendly', 'htmega-addons' );
    }

    public function get_icon() {
        return 'htmega-icon eicon-calendar';
    }
    public function get_categories() {
        return [ 'htmega-addons' ];
    }
    public function get_keywords() {
        return ['calendly', 'calender', 'booking', 'booked', 'appointment','metting schedule','htmega', 'ht mega'];
    }

    public function get_help_url() {
        return 'https://wphtmega.com/docs/';
    }
    protected function register_controls() {

        $this->start_controls_section(
            'calendly_source_section',
            [
                'label' => __( 'Calendly', 'htmega-addons' ),
            ]
        );
		$this->add_control(
			'calendly_username',
			[
				'label'       => __( 'Username', 'htmega-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( 'Type calendly username here', 'htmega-addons' ),
				'dynamic'     => ['active' => true],
				'render_type' => 'template',
				'label_block' => true
			]
		);

		$this->add_control(
			'calendly_time',
			[
				'label'   => __( 'Select Time', 'htmega-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'15min' => __( '15 Minutes', 'htmega-addons' ),
					'30min' => __( '30 Minutes', 'htmega-addons' ),
					'60min' => __( '60 Minutes', 'htmega-addons' ),
					'' => __( 'All', 'htmega-addons' ),
				],
				'default' => '30min'
			]
		);

		$this->add_control(
			'event_type_details',
			[
				'label'        => __( 'Hide Event Type Details', 'htmega-addons' ),
				'type'         => Controls_Manager::SWITCHER,
			]
		);

		$this->add_responsive_control(
			'calendly_wrap_height',
			[
				'label'      => __( 'Height', 'htmega-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 1000,
						'step' => 5,
					],
					'%'  => [
						'min' => 5,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => '680',
				],
				'selectors'  => [
					'{{WRAPPER}} .calendly-inline-widget' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .calendly-wrapper'       => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
        
		$this->start_controls_section(
			'calendly_style_section',
			[
				'label' => __( 'Calendly', 'htmega-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'text_color',
				[
					'label' => __( 'Text Color', 'htmega-addons' ),
					'type'  => Controls_Manager::COLOR,
					'alpha' => false,
				]
			);

			$this->add_control(
				'button_link_color',
				[
					'label' => __( 'Button & Link Color', 'htmega-addons' ),
					'type'  => Controls_Manager::COLOR,
					'alpha' => false,
				]
			);

			$this->add_control(
				'background_color',
				[
					'label' => __( 'Background Color', 'htmega-addons' ),
					'type'  => Controls_Manager::COLOR,
					'alpha' => false,
				]
			);

		$this->end_controls_section();
 

    }

    protected function render( $instance = [] ) {

			$settings = $this->get_settings_for_display();
		
			// Build the Calendly URL
			$calendly_time = !empty( $settings['calendly_time'] ) ? '/' . esc_attr( $settings['calendly_time'] ) : '';
			$calendly_event = ( 'yes' === $settings['event_type_details'] ) ? 'hide_event_type_details=1' : '';
		
			// Build the parameters array for query strings
			$parameters = [
				'text_color'       => !empty( $settings['text_color'] ) ? str_replace( '#', '', esc_attr( $settings['text_color'] ) ) : null,
				'primary_color'    => !empty( $settings['button_link_color'] ) ? str_replace('#', '', esc_attr( $settings['button_link_color'] ) ) : null,
				'background_color' => !empty( $settings['background_color'] ) ? str_replace( '#', '', esc_attr( $settings['background_color'] ) ) : null,
			];
		
			// Remove null values from the parameters array
			$parameters = array_filter($parameters);
		
			// Construct the final URL
			$requestUrl = 'https://calendly.com/' . esc_attr( $settings['calendly_username'] ) . $calendly_time . '/?' . $calendly_event;
			$final_url = $requestUrl . ( ! empty( $parameters ) ? '&' . http_build_query( $parameters ) : '' );
		
			// Render the widget only if the username is provided
			if ( ! empty( $settings['calendly_username'] ) ) {
				?>
				<div class="calendly-inline-widget" data-url="<?php echo esc_url( $final_url ); ?>" style="min-width:320px;"></div>
				<script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js"></script>
				<?php if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) : ?>
					<div class="calendly-wrapper" style="width:100%; position:absolute; top:0; left:0; z-index:100;"></div>
				<?php endif; ?>
				<?php
			} else {
				echo '<div class="htmega-error-notice">' . esc_html__( "Please enter a valid Calendly username.", "htmega-addons" ) . '</div>';
			}
		}

}