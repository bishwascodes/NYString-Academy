<?php

class NYS_Nav_Walker extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent  = str_repeat( "\t", $depth );
        $output .= "\n{$indent}<ul class=\"sub-menu\">\n";
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $indent  = str_repeat( "\t", $depth );
        $output .= "{$indent}\t<div class=\"sub-menu-close\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i>Close</div>\n";
        $output .= "{$indent}</ul>\n";
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = $depth ? str_repeat( "\t", $depth ) : '';

        $classes     = empty( $item->classes ) ? [] : (array) $item->classes;
        $classes[]   = 'menu-item-' . $item->ID;
        $class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $item_id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
        $item_id = $item_id ? ' id="' . esc_attr( $item_id ) . '"' : '';

        $output .= $indent . '<li' . $item_id . $class_names . '>';

        $has_children = in_array( 'menu-item-has-children', $classes );

        $atts           = [];
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target ) ? $item->target : '';
        $atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
        $atts['href']   = ! empty( $item->url ) ? $item->url : '';
        if ( ! empty( $item->target ) && '_blank' === $item->target ) {
            $atts['rel'] = 'noopener noreferrer';
        }

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( 'href' === $attr ) {
                continue;
            }
            if ( ! empty( $value ) ) {
                $attributes .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
            }
        }

        // Top-level parent items use javascript:void(0) so clicking opens the submenu
        if ( $depth === 0 && $has_children ) {
            $attributes .= ' href="javascript:void(0)"';
        } elseif ( ! empty( $atts['href'] ) ) {
            $attributes .= ' href="' . esc_url( $atts['href'] ) . '"';
        }

        $title        = apply_filters( 'the_title', $item->title, $item->ID );
        $title        = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
        $item_output  = isset( $args->before ) ? $args->before : '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= ( isset( $args->link_before ) ? $args->link_before : '' ) . $title . ( isset( $args->link_after ) ? $args->link_after : '' );
        $item_output .= '</a>';
        $item_output .= isset( $args->after ) ? $args->after : '';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $has_children = in_array( 'menu-item-has-children', (array) $item->classes );
        if ( $has_children ) {
            $output .= '<span class="rs-menu-parent"><i class="fa fa-angle-down" aria-hidden="true"></i></span>';
        }
        $output .= "</li>\n";
    }
}
