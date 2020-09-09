<?php
/**
 * The footer template.
 *
 * @package WordPress
 * @subpackage Schism
 * @since 1.0.0
 */

$evolvethemes_key = evolvethemes_theme_key();

do_action( 'schism_after_content' );
?>
<?php printf( '<footer class="%s-f">', esc_attr( $evolvethemes_key ) ); ?>
	<?php printf( '<div class="%1$s-row %1$s-row_break">', esc_attr( $evolvethemes_key ) ); ?>
		<?php printf( '<div class="%s-f__col">', esc_attr( $evolvethemes_key ) ); ?>
			<?php evolvethemes_get_widgetarea( 'footer-col-1', esc_attr( $evolvethemes_key ) . '-spacing' ); ?>
		</div>
		<?php printf( '<div class="%s-f__col">', esc_attr( $evolvethemes_key ) ); ?>
			<?php evolvethemes_get_widgetarea( 'footer-col-2', esc_attr( $evolvethemes_key ) . '-spacing' ); ?>
			<?php evolvethemes_get_widgetarea( 'footer-col-3', esc_attr( $evolvethemes_key ) . '-spacing' ); ?>
		</div>
		<?php printf( '<div class="%s-f__col">', esc_attr( $evolvethemes_key ) ); ?>
			<?php evolvethemes_get_widgetarea( 'footer-col-4', esc_attr( $evolvethemes_key ) . '-spacing' ); ?>
		</div>
	</div>

	<?php printf( '<div class="%1$s-row %1$s-row_break">', esc_attr( $evolvethemes_key ) ); ?>
		<?php printf( '<div class="%s-copy">', esc_attr( $evolvethemes_key ) ); ?>
			<p>
				&copy;
				<?php
				echo esc_html(
					date_i18n(
					/* translators: Copyright date format, see https://www.php.net/date */
						_x( 'Y', 'copyright date format', 'schism' )
					)
				);
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>,
				<?php
				printf(
					'%s <a href="%s" target="_blank">%s</a> %s',
					esc_html__( 'Designed by', 'schism' ),
					esc_url( 'https://justevolve.it/' ),
					esc_html( 'Evolve Themes' ),
					esc_html__( 'and proudly', 'schism' )
				);
				?>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'schism' ) ); ?>" target="_blank">
					<?php esc_html_e( 'Powered by WordPress', 'schism' ); ?>
				</a>
			</p>
		</div>
	</div>
</footer>
