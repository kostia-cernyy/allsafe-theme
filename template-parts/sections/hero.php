<?php
	$bg = get_field('hero_bg');

	$hero_slides = array();

	for ($i = 1; $i <= 4; $i++) {
		$image = get_field('hero_slide_' . $i);
		$alt   = get_field('slide_alt_' . $i);

		if ($image) {
			$hero_slides[] = array(
				'url' => $image['url'],
				'alt' => $alt ? $alt : __('Изображение для hero блока', 'allsafe'),
			);
		}
	}
?>

<section class="hero" style="background-image: url('<?php echo esc_url($bg['url']); ?>');">
	<div class="container">
		<div class="hero__visual js-hero-slider">
			<?php if (!empty($hero_slides)) : ?>
				<?php foreach ($hero_slides as $index => $slide) : ?>
					<img
						class="hero__item <?php echo $index === 0 ? 'is-active' : ''; ?>"
						src="<?php echo esc_url($slide['url']); ?>"
						alt="<?php echo esc_attr($slide['alt']); ?>"
					>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<div class="fade-up">
			<h1 class="hero__title"><?php the_field( 'hero_title' ); ?></h1>
			<p class="hero__text"><?php the_field( 'hero_text' ); ?></p>
		</div>
		<a href="#services" class="effect-scroll" aria-label="<?php echo esc_attr(pll__('Go to the next block')); ?>">
			<span class="effect-scroll__dot"></span>
		</a>
	</div>
</section>

<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/><br/>