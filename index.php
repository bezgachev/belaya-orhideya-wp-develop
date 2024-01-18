<?get_header();?>
<?
$flexible_content = get_sub_field('blocks'); 
if( have_rows('blocks') ):

    while( have_rows('blocks') ) : the_row();
        
        $layout = get_row_layout();
        get_template_part('parts/blocks/'.$layout.'');
    endwhile;

endif;
?>
<?get_footer();?>