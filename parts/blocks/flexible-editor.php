<?
if(!defined('ABSPATH')){exit;}

$display_type = get_sub_field('display_type');

if($display_type) {
    get_template_part('parts/blocks/flexible-editor/'.$display_type.'');
}