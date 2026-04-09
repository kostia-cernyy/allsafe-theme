<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package allsafe
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url(__('https://wordpress.org/', 'allsafe')); ?>">
				<?php
                /* translators: %s: CMS name, i.e. WordPress. */
                printf(esc_html__('Proudly powered by %s', 'allsafe'), 'WordPress');
?>
			</a>
			<span class="sep"> | </span>
				<?php
/* translators: 1: Theme name, 2: Theme author. */
printf(esc_html__('Theme: %1$s by %2$s.', 'allsafe'), 'allsafe', '<a href="http://underscores.me/">Underscores.me</a>');
?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<?php
$contacts = allsafe_get_contacts_data();
?>

<?php if ( $contacts['phone'] || $contacts['whatsapp'] ) : ?>
	<div class="mobile-cta" aria-label="<?php echo esc_attr(pll__('Quick Contacts')); ?>">
		<?php if ( $contacts['phone'] ) : ?>
			<a
				href="tel:<?php echo esc_attr( $contacts['phone_href'] ); ?>"
				class="mobile-cta__btn mobile-cta__btn--phone btn"
				aria-label="<?php echo esc_attr(pll__('Call')); ?>"
			>
				<?php echo get_icon('phone-call'); ?>
				<span class="header-tel"><?php echo esc_html(pll__('Call')); ?></span>
			</a>
		<?php endif; ?>

		<?php if ( $contacts['whatsapp'] ) : ?>
			<a
				href="https://wa.me/<?php echo esc_attr( $contacts['whatsapp_href'] ); ?><?php echo $contacts['whatsapp_message'] ? '?text=' . esc_attr( $contacts['whatsapp_message'] ) : ''; ?>"
				class="mobile-cta__btn mobile-cta__btn--whatsapp btn"
				target="_blank"
				rel="noopener noreferrer"
				aria-label="<?php echo esc_attr(pll__('Write on WhatsApp')); ?>"
			>
				<?php echo get_icon('whatsapp'); ?>
				<span class="header-tel">WhatsApp</span>
			</a>
		<?php endif; ?>
	</div>
<?php endif; ?>
</body>
</html>
