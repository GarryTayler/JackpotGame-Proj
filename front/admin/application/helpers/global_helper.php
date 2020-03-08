<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('generateRandomString')) {

    function generateRandomString( $length = 10 ) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }   
}

if ( ! function_exists('getCurrentTimeStamp')) {

    function getCurrentTimeStamp( ) {
        $date = date("Y-m-d")." 00:00:00";
        $datetime = new DateTime($date);

        return $datetime->getTimestamp();
    }   
}

if ( ! function_exists('str_cur_time')) {

    function str_cur_time() {
        return date('Y-m-d H:i:s');
    }
}

if (!function_exists('render_menu')) {
    function render_menu($menu, $cur_id, $isTop = false) {
        $is_active = false;
        echo '<li';
        if (is_array($menu['id'])) {
            if (in_array($cur_id, $menu['id'])) {
                $is_active = true;
            }
        } else {
            if ($cur_id == $menu['id']) {
                $is_active = true;
            }
        }
        if ($is_active) echo ' class="active"';
        echo '>';

        echo '<a ';
        $has_submenu = isset($menu['has_submenu']) ? $menu['has_submenu'] : false;
        $classes = array();
        if ($isTop) {
            $classes[] = 'waves-effect';
            $classes[] = 'waves-dark';
        }
        if ($has_submenu) {
            $classes[] = 'has-arrow';
        }
        if (count($classes)) {
            echo ' class="'.implode(' ', $classes).'" ';
        }
        if ($has_submenu) echo ' href="javascript:void(0);" ';
        else {
            echo ' href="'.site_url($menu['path']).'" ';
        }
        echo '>';
        if ($isTop) {
            echo '<i class="'.$menu['icon'].'"></i>';
            echo '<span class="hide-menu">';
            echo $menu['title'];
            if (isset($menu['badge'])) {
                // we don't need badge now...
            }
            echo '</span>';
        } else {
            echo $menu['title'];
        }
        echo '</a>';
        if ($has_submenu) {
            echo '<ul class="collapse';
            if ($is_active) echo ' in';
            echo '">';

            foreach ($menu['submenus'] as $smenu) {
                render_menu($smenu, $cur_id);
            }

            echo '</ul>';
        }
        echo '</li>';
    }
}
if (!function_exists('new_render_menu')) {
    function new_render_menu($menu, $cur_id) {
        $is_active = false;
        if (is_array($menu['id'])) {
            if (in_array($cur_id, $menu['id'])) {
                $is_active = true;
            }
        } else {
            if ($cur_id == $menu['id']) {
                $is_active = true;
            }
        }
        $active_class = '';
        if ($is_active) $active_class ="active";
        $has_submenu = isset($menu['has_submenu']) ? $menu['has_submenu'] : false;
        $active_class = ($is_active)? '--active':'';
        if (!$has_submenu) {
            echo '<li class="m-menu__item  m-menu__item'.$active_class.'" aria-haspopup="true">
                        <a href="'.base_url($menu['path']).'" class="m-menu__link ">
                            <i class="m-menu__link-icon '.$menu['icon'].'"></i>
                            <span class="m-menu__link-title">
                                <span class="m-menu__link-wrap">
                                    <span class="m-menu__link-text">
                                        '.$menu['title'].'
                                    </span>
                                </span>
                            </span>
                        </a>
                    </li>';
        } else {
            $active_class = ($is_active)? 'm-menu__item--open m-menu__item--expanded':'';
            echo '<li class="m-menu__item  m-menu__item--submenu '.$active_class.'" aria-haspopup="true" data-menu-submenu-toggle="hover">'.PHP_EOL;
            echo '<a href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon '.$menu['icon'].'"></i>
                    <span class="m-menu__link-text">
                        '.$menu['title'].'
                    </span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                 </a>'.PHP_EOL;
            echo '<div class="m-menu__submenu ">'.PHP_EOL;
            echo '<span class="m-menu__arrow"></span>'.PHP_EOL;
            echo '<ul class="m-menu__subnav">'.PHP_EOL;
            echo '<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                    <span class="m-menu__link">
                        <span class="m-menu__link-text">
                            '.$menu['title'].'
                        </span>
                    </span>
                </li>';
            foreach ($menu['submenus'] as $smenu) {
                $is_sub_active = ($smenu['id'] == $cur_id);
                $sub_active_class = ($is_sub_active)? 'm-menu__item--active':'';
                echo '<li class="m-menu__item '.$sub_active_class.'" aria-haspopup="true">
                            <a href="'.base_url($smenu['path']).'" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    '.$smenu['title'].'
                                </span>
                            </a>
                       </li>'.PHP_EOL;
            }
            echo '</ul>'.PHP_EOL;
            echo '</div>'.PHP_EOL;
            echo '</li>';
        }
    }
}
if (!function_exists('render_input')) {
    function render_input($input, $value = false, $show_label = true) {
        // input should have these fields
        // title, name, 
        // class, attr --> optional
        // tag(default is input), type(default is text), placeholder, value(for checkbox/radio)
        // options for select


        // first we render label for given input
        if ($show_label) {
            echo '<label class="control-label">'.$input['title'].'</label>';
        }
        if (!isset($input['tag'])) {
            $input['tag'] = 'input';
        }

        // then we render tag
        echo '<'.$input['tag']; // select, ...
        if ($input['tag'] == 'input') {
            if (isset($input['type'])) {
                echo ' type="'.$input['type'].'"';
                if ($input['type'] == 'checkbox' || $input['type'] == 'radio') {
                    if (isset($input['value'])) {
                        echo ' value="'.$input['value'].'"';
                        if ($input['value'] == $value) {
                            echo ' checked';
                        }
                    } else {
                        // error
                    }
                    // this time, it's checked ... for ...
                }
            } else {
                echo ' type="text"';
            }

            if (isset($input['placeholder'])) {
                echo ' placeholder="'.$input['placeholder'].'"';
            }
            if ($value) {
                echo ' value="'.$value.'"';
            }
        }
        echo ' name="'.$input['name'].'"';
        echo ' class="form-control';
        if (isset($input['class'])) {
            echo ' ';
            if (is_array($input['class'])) echo implode(' ', $input['class']);
            else echo $input['class'];
        }
        if (isset($input['attr'])) {
            foreach ($input['attr'] as $key => $value) {
                echo ' '.$key.'="'.$value.'"';
            }
        }
        echo '">';
        // now it's the contents -- for select
        if ($input['tag'] == 'select') {
            // then we should load options
            if (isset($input['options'])) {
                foreach ($input['options'] as $value => $title) {
                    echo '<option value="'.$value.'" >'.$title.'</option>';
                }
            } else {
                // error
            }
        }
        if ($input['tag'] != 'input') echo '</'.$input['tag'].'>';
    }
}

if (!function_exists('with_default')) {
    function with_default($option, $default) {
        if (isset($option)) return $option;
        return $default;
    }
}