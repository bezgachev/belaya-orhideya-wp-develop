</main>
<?$args = get_query_var('global_params');?>
<footer class="footer">
	<div class="footer__container">
		<?
		wp_nav_menu(array(
			'theme_location'  => 'footer',
			'menu_id'      => false,
			'container'       => 'div', 
			'container_class' => 'footer__items', 
			'menu_class'      => false,
			'items_wrap'      => '%3$s',
			'order' => 'ASC',      
			'walker' => new footer_nav()
		));
		?>
		<div class="footer__contacts">
			<div class="footer__wrapper">
				<?
				btn_generation_modal('footer', get_queried_object_id());
				if(isset($args['email'])) {
					echo '<a href="mailto:'.$args['email'].'" class="footer__mail">'.$args['email'].'</a>';
				}
                ?>
            </div>
			<?
			echo '<div class="social">';
			if(isset($args['socials']) && (!empty($args['socials']))) {
				$params_social = ['socials' => $args['socials']];
				get_template_part('parts/components/standart/social', null, $params_social);
			}
			echo '</div>';
			?>
		</div>
	</div>
	<div class="footer__bottom">
		<div class="footer__container">
			<span>Лицензия серия Л041-01131-12/00303998</span>
			<a class="privacy-policy" href="<?=get_privacy_policy_url();?>" target="_blank">Политика конфиденциальности</a>
			<a class="weblitex" target="_blank" href="https://weblitex.ru/?utm_source=clients&utm_medium=referal&utm_campaign=belayaorhideya.ru">
				Разработка сайтов для стоматологий Комплексные решения компании «Лайтекс»
			</a>
		</div>
	</div>
</footer>

<section class="form-block popup">
	<div class="form-block__container">
		<div class="form-wrapper">
			<button class="close"></button>
			<div class="form-content">
				<h2 class="form-content_title">Закажите звонок</h2>
				<div class="form-content_descr">Ответим на вопросы о лечении или запишем на прием</div>
			</div>
			
			<form action="user_forms_action" method="POST" class="form" id="popup-form">
				<div class="form__hidden"></div>
				<div class="form__hidden_wp">
					<?wp_nonce_field('backend-nonce', 'check_nonce');?>
				</div>
				<div class="form__submit">
					<button class="btn">Отправить</button> <span class="form__submit_checkbox">
						Отправляя форму, вы даете согласие на обработку <a href="<?=get_privacy_policy_url();?>" target="_blank">персональных данных </a>
					</span>
				</div>
			</form>
		</div>
	</div>
	<div class="response d-hide">
		<div class="img-ok">
			<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M42.1793 5.77148C39.0547 5.77148 36.3533 7.61201 35.1018 10.2641H2.82969C1.26943 10.2641 0 11.5311 0 13.0885V41.4014C0 42.9603 1.26943 44.2285 2.82969 44.2285H42.6748C44.2352 44.2285 45.5045 42.9603 45.5045 41.4014V20.6519C48.1584 19.4012 50 16.7035 50 13.5833C50 9.27588 46.4917 5.77148 42.1793 5.77148Z" fill="#FBD1BA"></path>
				<path d="M2.82968 44.2286H42.6748C43.453 44.2286 44.1587 43.913 44.6708 43.4034L25.9439 27.2463L22.7522 30L19.5605 27.2463L0.833191 43.4028C1.3453 43.9127 2.05126 44.2286 2.82968 44.2286Z" fill="#FBBD9C"></path>
				<path d="M34.3588 13.5834C34.3579 12.4356 34.6117 11.302 35.102 10.2642H2.82988C2.05195 10.2642 1.34648 10.5792 0.834473 11.088L22.7524 30L36.097 18.4862C35.011 17.1446 34.3588 15.4391 34.3588 13.5834Z" fill="#FFE6D8"></path>
				<path d="M41 23C45.9706 23 50 18.9706 50 14C50 9.02944 45.9706 5 41 5C36.0294 5 32 9.02944 32 14C32 18.9706 36.0294 23 41 23Z" fill="#85D392"></path>
				<path d="M40.9529 5C40.6311 5 40.3133 5.01744 40 5.05029C44.5423 5.52553 48.0942 9.35759 48.0942 13.9999C48.0942 18.6424 44.5423 22.4745 40 22.9497C40.3133 22.9824 40.6311 23 40.9529 23C45.9415 23 50 18.9626 50 14.0001C50 9.03739 45.9415 5 40.9529 5Z" fill="#4F9F5C"></path>
				<path d="M45.67 11.7L39.4 17.4L39.0699 17.6999C38.8719 17.9 38.5859 18 38.2999 18C38.0139 18 37.7279 17.9 37.53 17.6999L35.33 15.7C34.89 15.32 34.89 14.68 35.33 14.2999C35.748 13.9 36.4519 13.9 36.87 14.2999L38.3001 15.58L39.4001 14.5799L44.1302 10.3C44.5482 9.90002 45.2521 9.90002 45.6702 10.3C46.11 10.68 46.11 11.32 45.67 11.7Z" fill="white"></path>
			</svg>
		</div>
		<div class="img-err d-hide">
			<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M42.1793 5.77148C39.0547 5.77148 36.3533 7.61201 35.1018 10.2641H2.82969C1.26943 10.2641 0 11.5311 0 13.0885V41.4014C0 42.9603 1.26943 44.2285 2.82969 44.2285H42.6748C44.2352 44.2285 45.5045 42.9603 45.5045 41.4014V20.6519C48.1584 19.4012 50 16.7035 50 13.5833C50 9.27588 46.4917 5.77148 42.1793 5.77148Z" fill="#FBD1BA"></path>
				<path d="M2.82968 44.2286H42.6748C43.453 44.2286 44.1587 43.913 44.6708 43.4034L25.9439 27.2463L22.7522 30L19.5605 27.2463L0.833191 43.4028C1.3453 43.9127 2.05126 44.2286 2.82968 44.2286Z" fill="#FBBD9C"></path>
				<path d="M34.3588 13.5834C34.3579 12.4356 34.6117 11.302 35.102 10.2642H2.82988C2.05195 10.2642 1.34648 10.5792 0.834473 11.088L22.7524 30L36.097 18.4862C35.011 17.1446 34.3588 15.4391 34.3588 13.5834Z" fill="#FFE6D8"></path>
				<path d="M41 23C45.9706 23 50 18.9706 50 14C50 9.02944 45.9706 5 41 5C36.0294 5 32 9.02944 32 14C32 18.9706 36.0294 23 41 23Z" fill="#F17770"></path>
				<path d="M40.9529 5C40.6311 5 40.3133 5.01744 40 5.05029C44.5423 5.52553 48.0942 9.35759 48.0942 13.9999C48.0942 18.6424 44.5423 22.4745 40 22.9497C40.3133 22.9824 40.6311 23 40.9529 23C45.9415 23 50 18.9626 50 14.0001C50 9.03739 45.9415 5 40.9529 5Z" fill="#C04F48"></path>
				<path d="M39.7619 18.1867C39.7619 17.4477 40.3162 16.8474 41 16.8474C41.6838 16.8474 42.2382 17.4477 42.2382 18.1867C42.2382 18.9264 41.6838 19.5261 41 19.5261C40.3162 19.5261 39.7619 18.9264 39.7619 18.1867Z" fill="white"></path>
				<path d="M41.6666 14.8914C41.6397 15.2396 41.3493 15.5085 41 15.5085C40.6507 15.5085 40.3603 15.2396 40.3335 14.8914L39.857 8.70667C39.8057 8.04078 40.3322 7.47217 41 7.47217C41.6679 7.47217 42.1944 8.04078 42.1431 8.70667L41.6666 14.8914Z" fill="white"></path>
			</svg>
		</div>
		<h2 class="title">Заявка отправлена</h2>
		<p class="subtitle">Совсем скоро мы свяжемся с вами</p>
	</div>
	<div class="overlay"></div>
</section>

<div class="cookie">
	<div class="cookie__text">Мы используем cookie-файлы, чтобы вам было удобнее пользоваться нашим сайтом.</div>
	<button class="btn">Принять</button><a href="<?=get_privacy_policy_url();?>" class="cookie__link"><span>Подробнее</span></a>
</div>
<div class="ask-social">
	<div class="ask-social__body">
		<button class="close"></button>
		<?
			if(isset($args['socials']) && (!empty($args['socials']))) {
				$params_social = ['socials' => $args['socials'], 'type' => 'to-ask', 'full_echo' => true];
				get_template_part('parts/components/standart/social', null, $params_social);
			}
		?>
	</div>
	<button class="ask-social__btn">
		<div>
			<?
				if(isset($args['socials']) && (!empty($args['socials']))) {
					$params_social = ['socials' => $args['socials'], 'type' => 'to-ask', 'full_echo' => false];
					get_template_part('parts/components/standart/social', null, $params_social);
				}
			?>
			<p>Мне только спросить</p>
		</div>
	</button>
	<div class="ask-social__overlay"></div>
</div>
<?wp_footer();?>
</body>
</html>