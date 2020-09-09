<?php 

/* Admela : Comment Tempplate page
*
* @package WordPress
* @subpackage admela
* @since Admela 1.0
*/


/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}


?>

<div id="admela_commentbox" class="admela_commentbox admela_comment_section"> <!--Comment section-->
  
  <?php
	
	$admela_commenter = wp_get_current_commenter();
	$admela_commentreq = get_option( 'require_name_email' );
	$admela_aria_req = ( $admela_commentreq ? " aria-required='true'" : '' ); 


	$admela_commentfields =  array(
	'author' => '<p class="admela-comment-form-author"><label for="author">' . esc_html__( 'Name', 'admela' ) . '</label> ' . ( $admela_commentreq ? '<span class="required">*</span>' : '' ) . '<input id="author" name="author" type="text" value="' . esc_attr( $admela_commenter['comment_author'] ) . '" size="30"' . esc_attr($admela_aria_req) . ' /></p>',
	'email' => '<p class="admela-comment-form-email"><label for="email">' . esc_html__( 'Email', 'admela' ) . '</label> ' . ( $admela_commentreq ? '<span class="required">*</span>' : '' ) . '<input id="email" name="email" type="text" value="' . esc_attr(  $admela_commenter['comment_author_email'] ) . '" size="30"' . esc_attr($admela_aria_req) . ' /></p>',
	'url' => '<p class="admela-comment-form-url"><label for="url">' . esc_html__( 'Website', 'admela' ) . '</label><input id="url" name="url" type="text" value="' . esc_url( $admela_commenter['comment_author_url'] ) . '" size="30" /></p>'
	); 


	$admela_comment_args = array(
	'id_form' => 'commentform',
	'id_submit' => esc_html__( 'submit', 'admela' ),
	'title_reply' => esc_html__( 'Leave a Reply' , 'admela' ),
	'title_reply_to' => esc_html__( 'Leave a Reply to %s' , 'admela' ),
	'cancel_reply_link' => esc_html__( 'Cancel Reply' , 'admela' ),
	'label_submit' => esc_html__( 'Post Comment' , 'admela' ),
	'comment_field' => '<p class="admela-comment-form-comment"><textarea id="comment" name="comment" rows="20" cols="100" aria-required="true"></textarea></p>',
	'must_log_in' => '<p class="must-log-in">'.wp_kses( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'admela' ), wp_login_url( apply_filters( 'the_permalink', esc_url(get_permalink( ) ) )) ).'
	</p>',
	'logged_in_as' => '<p class="logged-in-as">
	
	'.wp_kses( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'admela' ), esc_url(admin_url( 'profile.php' )), $user_identity, wp_logout_url( apply_filters( 'the_permalink', esc_url(get_permalink( ))))).'
	
	</p>',
	'comment_notes_before' => '<p class="comment-notes">
	' . esc_html__( 'Your email address will not be published.' , 'admela' ).  '</p>',
	'comment_notes_after' => '<p class="form-allowed-tags">
	'.wp_kses( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'admela' ), ' <code>' .esc_attr(allowed_tags()). '</code>').'
	</p>',
	'fields' => apply_filters( 'comment_form_default_fields', array(
	'author' => '<p class="admela-comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'admela' ) . '</label> ' . ( $admela_commentreq ? '<span class="required">*</span>' : '' ) . '<input id="author" name="author" type="text" value="' . esc_attr( $admela_commenter['comment_author'] ) . '" size="30"' . esc_attr($admela_aria_req) . ' /></p>',
	'email' => '<p class="admela-comment-form-email"><label for="email">' . esc_html__( 'Email', 'admela' ) . '</label> ' . ( $admela_commentreq ? '<span class="required">*</span>' : '' ) . '<input id="email" name="email" type="text" value="' . esc_attr(  $admela_commenter['comment_author_email'] ) . '" size="30"' . esc_attr($admela_aria_req) . ' /></p>',
	'url' => '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'admela' ) . '</label>' . '<input id="url" name="url" type="text" value="' . esc_attr( $admela_commenter['comment_author_url'] ) . '" size="30" /></p>' ) ) ); ?>
  <div class="admela_total_comments">
   
           <?php $admela_comment_title = get_post_field('comment_count',get_the_ID());
				if ($admela_comment_title >= 1):
				echo '<h3>'.absint($admela_comment_title).' <span> '.esc_html__('Comments','admela').'</span> </h3>';			
				else:
				echo ''; 
				endif;
			?>
    
  </div> <!-- .admela_total_comments -->
  <?php
	
	if(get_comments_number()):
	
	the_comments_navigation(); 
	
	?>
  <ol class="admela_commentlist" itemscope="itemscope" itemtype="http://schema.org/UserComments">
    <?php
			// show regular comments
			wp_list_comments(
			array (				
				'style'    => 'ul',
				'short_ping'  => true,
				'avatar_size' => '80'
				)
			);
		?>
  </ol> <!-- .admela_commentlist -->
  <?php
	
	the_comments_navigation();
	
	endif;
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
  <p class="admela_nocomments">
    <?php esc_html_e( 'Comments are closed.', 'admela' ); ?>
  </p>
  <?php endif; ?>
  <?php $admela_comments_args = array(

		// change the title of send button 
		'label_submit'=> esc_html__('Submit','admela'),

		// change the title of the reply section
		'title_reply'=> esc_html__('Leave a Comment','admela'),

		// remove "Text or HTML to be displayed after the set of comment fields"
		'comment_notes_after' => '',

		// redefine your own textarea (the comment body)
		'comment_field' => '<p class="admela-comment-form-comment"><textarea id="comment" name="comment" rows="10" cols="100" aria-required="true"></textarea></p>',
	);

	comment_form($admela_comments_args); 
	
   ?>
</div> <!-- #admela_commentbox -->
 
