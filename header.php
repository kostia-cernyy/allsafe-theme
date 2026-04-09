<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package allsafe
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="header" id="header">
	<div class="container header-row">
		<div class="header-logo">
			<?php the_custom_logo(); ?>
		</div>
		<nav class="header-nav" aria-label="<?php echo esc_attr(pll__('Primary navigation')); ?>">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'header_menu',
						'container'      => false,
						'menu_class'     => 'header-menu',
						'menu_id'        => 'header-menu',
						'fallback_cb'    => false,
					)
				);
			?>
		</nav>
		<div class="header-contacts">
			<?php
				$phone = get_contact_phone();
				if ($phone) : $phone_href = preg_replace('/[^0-9+]/', '', $phone);
			?>
			<a href="tel:<?php echo esc_attr($phone_href); ?>" class="header-phone">
				<?php echo get_icon('phone-call'); ?>
				<span class="header-tel"><?php echo esc_html($phone); ?></span>
			</a>
			<?php endif; ?>
		</div>
		<div class="header__languages-switcher">
			<?php if (function_exists('pll_the_languages')) : ?>
				<?php $languages = pll_the_languages(array(
					'raw' => 1,
				)); ?>
				<?php if (!empty($languages)) : ?>
					<div class="header__languages">
						<?php $i = 0; ?>
						<?php foreach ($languages as $lang) : ?>
							<a
								href="<?php echo esc_url($lang['url']); ?>"
								class="header__language <?php echo $lang['current_lang'] ? 'is-active' : ''; ?>"
							>
								<?php echo esc_html(strtoupper($lang['slug'])); ?>
							</a>
							<?php if ($i < count($languages) - 1) : ?>
								<span class="header__lang-divider"> | </span>
							<?php endif; ?>
							<?php $i++; ?>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<button 
			class="burger" 
			type="button" 
			aria-label="<?php echo esc_attr(pll__('Open menu')); ?>" 
			data-open-label="<?php echo esc_attr(pll__('Open menu')); ?>"
			data-close-label="<?php echo esc_attr(pll__('Close menu')); ?>" 
			aria-expanded="false" 
			aria-controls="mobile-menu">
				<span></span>
				<span></span>
				<span></span>
		</button>
	</div>
	<div 
		class="mobile-menu" 
		id="mobile-menu"
		data-open-submenu="<?php echo esc_attr( pll__('Open a submenu') ); ?>"
    	data-close-submenu="<?php echo esc_attr( pll__('Close the submenu') ); ?>"
	>
		<div class="mobile-lang-switcher">
			<?php if (function_exists('pll_the_languages')) : ?>
				<?php $languages = pll_the_languages(array(
					'raw' => 1,
				)); ?>
				<?php if (!empty($languages)) : ?>
					<div class="header__languages">
						<?php $i = 0; ?>
						<?php foreach ($languages as $lang) : ?>
							<a
								href="<?php echo esc_url($lang['url']); ?>"
								class="header__language <?php echo $lang['current_lang'] ? 'is-active' : ''; ?>"
							>
								<?php echo esc_html(strtoupper($lang['slug'])); ?>
							</a>
							<?php if ($i < count($languages) - 1) : ?>
								<span class="header__lang-divider"> | </span>
							<?php endif; ?>
							<?php $i++; ?>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<nav class="mobile-menu__nav" aria-label="<?php echo esc_attr(pll__('Mobile navigation')); ?>">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'header_menu',
						'container'      => false,
						'menu_class'     => 'mobile-menu__list',
						'fallback_cb'    => false,
					)
				);
			?>
		</nav>
	</div>
</header>