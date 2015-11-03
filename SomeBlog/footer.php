	<footer>
		<div class="main_footer">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="footer_widget_box">

							<?php if ( ! dynamic_sidebar( 'footer-1' ) ) : ?>

							<?php endif; ?>

						</div>
					</div>

					<div class="col-md-4">
						<div class="footer_widget_box">

							<?php if ( ! dynamic_sidebar( 'footer-2' ) ) : ?>

							<?php endif; ?>

						</div>
					</div>

					<div class="col-md-4">
						<div class="footer_widget_box">

							<?php if ( ! dynamic_sidebar( 'footer-3' ) ) : ?>

							<?php endif; ?>

						</div>
					</div>
				</div>
			</div>
		</div> <!-- //main_footer -->

		<div class="footer_copyright">
			<div class="container">
				<div>
					<?php show_creds(); ?>
				</div>
			</div>
		</div>

	</footer>

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
	<?php wp_footer(); ?>
</body>
</html>