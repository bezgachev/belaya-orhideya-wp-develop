<?
if(!defined('ABSPATH')){exit;}
$term = $args;
$term_id = $term->term_id;
$name = $term->name;
$description = $term->description;
$slug = $term->slug;
$surname = get_field('specialist-name', 'doctors_'.$term_id);
$img = get_field('specialist-img', 'doctors_'.$term_id);
$experience = get_field('experience', 'doctors_'.$term_id);
$professions = get_field('specialist-profession', 'doctors_'.$term_id);
$current_year = date("Y");
$experience_year = $current_year - $experience;
$descr_array = [
    get_field_object('specialist-descr-1', 'doctors_'.$term_id),
    get_field_object('specialist-descr-2', 'doctors_'.$term_id),
    get_field_object('specialist-descr-3', 'doctors_'.$term_id)
];
$certificates = get_field_object('specialist-certificates', 'doctors_'.$term_id);
?>
<section class="specialist">
    <div class="specialist__container">
        <div class="specialist__wrapper">
            <div class="specialist__body">
                <div class="specialist__title">
                    <span class="specialist__title_experience">
                        Стаж <?=$experience_year;?> <?=inclination_years(substr($experience_year, -1), $experience_year);?>
                    </span>
                    <?
                        $check_term = false;
                        $alternatives = array('21', '24');
                        foreach ($alternatives as $alternative) {
                            if(strpos(serialize($professions),$alternative)!==false) {
                                $check_term = true;
                            }
                        }
                    ?>
                    <h1><?=$name;?> <?=$surname;?></h1>
                    <p>
                        <?
                            echo ($check_term) ? null : 'Врач ';
                            foreach($professions as $value) {
                                $value = $value->name;
                                echo ($check_term) ? $value : mb_strtolower($value);
                                echo (next($professions)) ? ', ' : null;
                            }
                        ?>
                    </p>
                    <?
                    btn_generation_modal('single_doctor', get_queried_object_id());?>
                </div>
                <?
                foreach ($descr_array as $descr) {
                    if (isset($descr['value'])) {
                        $value = $descr['value'];
                        if(!empty($value)) {
                            $label = $descr['label'];
                            echo '<div class="specialist__descr">';
                                echo '<h2>'.$label.'</h2>';
                                    echo '<ul>';
                                        $text_array = preg_split('/<br[^>]*>/i', $value);
                                        foreach($text_array as $text) {

                                            echo '<li>'.$text.'</li>';
                                        }
                                    echo '</ul>';
                            echo '</div>';
                        }
                    }
                }
                ?>
            </div>
            <div class="specialist__image sticky">
                <div class="specialist__img">
                    <svg width="494" height="494" viewBox="0 0 494 494" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M494 0H0V494H494V0ZM110.38 102.453C182.405 40.9134 278.742 -7.94999 368.182 40.1736C464.912 92.2212 506.401 204.35 486.405 304.778C467.035 402.059 384.165 470.701 280.838 478.852C173.808 487.293 59.1988 439.622 14.9733 341.963C-26.1691 251.116 37.6685 164.58 110.38 102.453Z" fill="white"></path></svg>
                    <img src="<?=$img;?>" alt="<?=$name;?> <?=$surname;?>">
                </div>
                <?
                    if(!empty($description)) {
                        echo '<div class="specialist__quote">';
                        echo $description;
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>
    <?
    if(!empty($certificates['value'])) {
    ?>
        <div class="specialist__qualification container">
            <h2><?=$certificates['label']?></h2>
            <div class="specialist__slider swiper">
                <div class="specialist__nav">
                    <p>Наши специалисты посещают семинары и мастер-классы, чтобы повышать свою квалификацию и становиться лучшими в своем деле</p>
                    <nav>
                        <div class="slider-prev specialist-prev"></div>
                        <div class="slider-next specialist-next"></div>
                    </nav>
                </div>
                <div class="swiper-wrapper">
                    <?
                    foreach ($certificates['value'] as $key => $item) {
                        echo '<div class="swiper-slide" data-id="'.($key).'">';
                        echo '<img src="'.$item.'" alt="Сертификат-'.($key+1).'">';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    <?}?>
</section>
<?
if(!empty($certificates['value'])) {
?>
<section class="fullscreen">
	<div class="fullscreen__container">
		<div class="fullscreen-swiper swiper">
			<div class="fullscreen-wrapper swiper-wrapper">
			</div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
		</div>
		<div class='fullscreen-overlay'></div>
		<div class='fullscreen-close'></div>
	</div>
</section>
<?}?>