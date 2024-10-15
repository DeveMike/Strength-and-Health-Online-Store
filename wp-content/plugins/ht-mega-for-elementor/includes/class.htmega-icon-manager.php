<?php

namespace Elementor;

/**
* Icon render
*/
class HTMega_Icon_manager extends Icons_Manager{

    private static function render_svg_icon( $value ) {
        if ( ! isset( $value['id'] ) ) {
            return '';
        }
        return \Elementor\Core\Files\File_Types\Svg::get_inline_svg( $value['id'] );
    }

    private static function render_icon_html( $icon, $attributes = [], $tag = 'i' ) {
        $icon_types = self::get_icon_manager_tabs();
        if ( isset( $icon_types[ $icon['library'] ]['render_callback'] ) && is_callable( $icon_types[ $icon['library'] ]['render_callback'] ) ) {
            return call_user_func_array( $icon_types[ $icon['library'] ]['render_callback'], [ $icon, $attributes, $tag ] );
        }

        if ( empty( $attributes['class'] ) ) {
            $attributes['class'] = $icon['value'];
        } else {
            if ( is_array( $attributes['class'] ) ) {
                $attributes['class'][] = $icon['value'];
            } else {
                $attributes['class'] .= ' ' . $icon['value'];
            }
        }
        return '<' . $tag . ' ' . Utils::render_html_attributes( $attributes ) . '></' . $tag . '>';
    }

    public static function render_icon( $icon, $attributes = [], $tag = 'i' ) {
        ob_start(); 
        Icons_Manager::render_icon(  $icon, $attributes = [], $tag = 'i' );
        
        $icon_html = ob_get_clean(); 
        return $icon_html;
    }

}