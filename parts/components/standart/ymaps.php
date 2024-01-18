<?if(!defined('ABSPATH')){exit;}
$args = get_query_var('global_params');
$geo = $args['geo'];
$gis = $args['gis'];
if(empty($geo) || empty($gis)) {
    return;
}
$city = (!empty($args['city'])) ? ''.$args['city'].', ' : null;
$address = (!empty($args['address'])) ? $args['address'] : null;
$address_default = $city .''. $address;
$maps_title = (!empty($args['maps_title'])) ? $args['maps_title'] : 'Адрес';
$maps_subtitle = (!empty($args['maps_subtitle'])) ? $args['maps_subtitle'] : $address_default;
?>
<div class="contacts__map">
    <div class="contacts__map-address d-hide">
        <span data-title="<?=$maps_title;?>" data-subtitle="<?=$maps_subtitle;?>"
            data-geo="<?=$geo;?>" data-2gis="<?=$gis;?>">
        </span>
    </div>
    <div class="map" id="map"></div>
</div>
<?enabled_scripts_yandex_maps(true);?>