<?php

namespace ResponsiveMenu\Validation;

class Validator {

    private $errors;

    public function validate($options) {
        foreach($options as $key => $value):
            if(isset($this->validation_map[$key])):
                $validator_name = 'ResponsiveMenu\Validation\Validators\\' . $this->validation_map[$key]['validator'];
                $validator = new $validator_name($value);
                if(!$validator->validate()):
                    $nice_name = isset($this->validation_map[$key]['nice_name']) ? $this->validation_map[$key]['nice_name'] : str_replace('_', ' ', ucwords($key));
                    $this->errors[$key] = 'Validation failed on <a class="validation-error" href="#responsive-menu-' . str_replace('_', '-', $key) . '">'  . $nice_name . '</a>: ' . $validator->getErrorMessage();
                endif;
            endif;
        endforeach;

        if(!empty($this->errors))
            return false;

        return true;
    }

    public function getErrors() {
        return $this->errors;
    }

    private $validation_map = [

        // Numeric Validators
        'breakpoint' => ['validator' => 'Numeric'],
        'button_line_width' => ['validator' => 'Numeric'],
        'button_line_height' => ['validator' => 'Numeric'],
        'button_line_margin' => ['validator' => 'Numeric'],
        'button_width' => ['validator' => 'Numeric'],
        'button_height' => ['validator' => 'Numeric'],
        'button_top' => ['validator' => 'Numeric'],
        'animation_speed' => ['validator' => 'Numeric'],
        'transition_speed' => ['validator' => 'Numeric'],
        'button_font_size' => ['validator' => 'Numeric'],
        'button_title_line_height' => ['validator' => 'Numeric'],
        'menu_width' => ['validator' => 'Numeric'],
        'menu_title_font_size' => ['validator' => 'Numeric'],
        'menu_border_width' => ['validator' => 'Numeric'],
        'menu_font_size' => ['validator' => 'Numeric'],
        'menu_links_height' => ['validator' => 'Numeric'],
        'submenu_arrow_height' => ['validator' => 'Numeric'],
        'submenu_arrow_width' => ['validator' => 'Numeric'],
        'header_bar_height' => ['validator' => 'Numeric'],
        'header_bar_font_size' => ['validator' => 'Numeric'],
        'single_menu_height' => ['validator' => 'Numeric'],
        'single_menu_font_size' => ['validator' => 'Numeric'],
        'single_menu_submenu_font_size' => ['validator' => 'Numeric'],
        'single_menu_submenu_height' => ['validator' => 'Numeric'],

        // Colour Validators
        'button_background_colour' => ['validator' => 'Colour'],
        'button_background_colour_hover' => ['validator' => 'Colour'],
        'button_line_colour' => ['validator' => 'Colour'],
        'button_text_colour' => ['validator' => 'Colour'],
        'menu_background_colour' => ['validator' => 'Colour'],
        'menu_item_background_colour' => ['validator' => 'Colour'],
        'menu_item_background_hover_colour' => ['validator' => 'Colour'],
        'menu_item_border_colour' => ['validator' => 'Colour'],
        'menu_item_border_colour_hover' => ['validator' => 'Colour'],
        'menu_title_background_colour' => ['validator' => 'Colour'],
        'menu_title_background_hover_colour' => ['validator' => 'Colour'],
        'menu_current_item_background_colour' => ['validator' => 'Colour'],
        'menu_current_item_background_hover_colour' => ['validator' => 'Colour'],
        'menu_current_item_border_colour' => ['validator' => 'Colour'],
        'menu_current_item_border_hover_colour' => ['validator' => 'Colour'],
        'menu_title_colour' => ['validator' => 'Colour'],
        'menu_title_hover_colour' => ['validator' => 'Colour'],
        'menu_link_colour' => ['validator' => 'Colour'],
        'menu_link_hover_colour' => ['validator' => 'Colour'],
        'menu_current_link_colour' => ['validator' => 'Colour'],
        'menu_current_link_hover_colour' => ['validator' => 'Colour'],
        'menu_sub_arrow_border_colour' => ['validator' => 'Colour'],
        'menu_sub_arrow_border_hover_colour' => ['validator' => 'Colour'],
        'menu_sub_arrow_border_colour_active' => ['validator' => 'Colour'],
        'menu_sub_arrow_border_hover_colour_active' => ['validator' => 'Colour'],
        'menu_sub_arrow_background_colour' => ['validator' => 'Colour'],
        'menu_sub_arrow_background_hover_colour' => ['validator' => 'Colour'],
        'menu_sub_arrow_background_colour_active' => ['validator' => 'Colour'],
        'menu_sub_arrow_background_hover_colour_active' => ['validator' => 'Colour'],
        'menu_sub_arrow_shape_colour' => ['validator' => 'Colour'],
        'menu_sub_arrow_shape_hover_colour' => ['validator' => 'Colour'],
        'menu_sub_arrow_shape_colour_active' => ['validator' => 'Colour'],
        'menu_sub_arrow_shape_hover_colour_active' => ['validator' => 'Colour'],
        'menu_additional_content_colour' => ['validator' => 'Colour'],
        'menu_overlay_colour' => ['validator' => 'Colour'],
        'menu_search_box_text_colour' => ['validator' => 'Colour'],
        'menu_search_box_border_colour' => ['validator' => 'Colour'],
        'menu_search_box_background_colour' => ['validator' => 'Colour'],
        'menu_search_box_placeholder_colour' => ['validator' => 'Colour'],
        'single_menu_item_link_colour' => ['validator' => 'Colour'],
        'single_menu_item_link_colour_hover' => ['validator' => 'Colour'],
        'single_menu_item_background_colour' => ['validator' => 'Colour'],
        'single_menu_item_background_colour_hover' => ['validator' => 'Colour'],
        'single_menu_item_submenu_link_colour' => ['validator' => 'Colour'],
        'single_menu_item_submenu_link_colour_hover' => ['validator' => 'Colour'],
        'single_menu_item_submenu_background_colour' => ['validator' => 'Colour'],
        'single_menu_item_submenu_background_colour_hover' => ['validator' => 'Colour'],
        'header_bar_background_color' => ['validator' => 'Colour'],
        'header_bar_text_color' => ['validator' => 'Colour']
    ];
    
}