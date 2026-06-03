<?php
/**
 * Child Theme Footer
 */
?>

<footer id="rs-footer" class="bg8 blue-bg rs-footer " style="background-image:url(https://nystrings.bishwas.me/wp-content/uploads/2026/06/music-elements.png)!important;">
<div class="blue-overlay"></div>
<div class="container">
	<div>
		<div class="row footer-contact-desc">
			<div class="col-md-6">
				<div class="contact-inner">
					<svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg " width="35px"xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve" fill="#e6695b" stroke="#e6695b"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill="#eb6e60" d="M32,0C18.746,0,8,10.746,8,24c0,5.219,1.711,10.008,4.555,13.93c0.051,0.094,0.059,0.199,0.117,0.289l16,24 C29.414,63.332,30.664,64,32,64s2.586-0.668,3.328-1.781l16-24c0.059-0.09,0.066-0.195,0.117-0.289C54.289,34.008,56,29.219,56,24 C56,10.746,45.254,0,32,0z M32,32c-4.418,0-8-3.582-8-8s3.582-8,8-8s8,3.582,8,8S36.418,32,32,32z"></path> </g></svg>
					<?php $post_id = 85; $address=get_field('address',$post_id);
					if($post_id){
					?>
					<h4 class="contact-title"><?php echo esc_html(get_the_title($post_id)); ?>
					</h4>
					<?php } ?>
					<p class="contact-desc"><? echo $address; ?></p>
				</div>
			</div>
			<div class="col-md-6">
				<div class="contact-inner">
					<svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg" width="35px" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve" fill="#e6695b" stroke="#e6695b"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill="#eb6e60" d="M32,0C18.746,0,8,10.746,8,24c0,5.219,1.711,10.008,4.555,13.93c0.051,0.094,0.059,0.199,0.117,0.289l16,24 C29.414,63.332,30.664,64,32,64s2.586-0.668,3.328-1.781l16-24c0.059-0.09,0.066-0.195,0.117-0.289C54.289,34.008,56,29.219,56,24 C56,10.746,45.254,0,32,0z M32,32c-4.418,0-8-3.582-8-8s3.582-8,8-8s8,3.582,8,8S36.418,32,32,32z"></path> </g></svg>
					<?php $post_id = 84; $address=get_field('address',$post_id);
					if($post_id){
					?>
					<h4 class="contact-title"><?php echo esc_html(get_the_title($post_id)); ?>
					</h4>
					<?php } ?>
					<p class="contact-desc"><? echo $address; ?></p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="footer-top">
	<div class="container">

	</div>
</div>

<div class="footer-bottom">
	<div class="container">
		<div class="copyright">
			<p>
				© <?php echo date('Y'); ?> <a href="#">NY STRING ACADEMY</a>. All Rights Reserved.
			</p>
		</div>
	</div>
</div>

</footer>

<?php wp_footer(); ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
</body>
</html>