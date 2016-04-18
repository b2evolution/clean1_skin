<?php
/**
 * This is the main/default page template.
 *
 * For a quick explanation of b2evo 2.0 skins, please start here:
 * {@link http://manual.b2evolution.net/Skins_2.0}
 *
 * The main page template is used to display the blog when no specific page template is available
 * to handle the request (based on $disp).
 *
 * @package evoskins
 * @subpackage clean1
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );

if( version_compare( $app_version, '4.0.0-dev' ) < 0 )
{ // Older 2.x skins work on newer 2.x b2evo versions, but newer 2.x skins may not work on older 2.x b2evo versions.
	die( 'This skin is designed for b2evolution 4.0.0 and above. Please <a href="http://b2evolution.net/downloads/index.html">upgrade your b2evolution</a>.' );
}

// This is the main template; it may be used to display very different things.
// Do inits depending on current $disp:
skin_init( $disp );


// -------------------------- HTML HEADER INCLUDED HERE --------------------------
skin_include( '_html_header.inc.php', array(
		'viewport_tag' => '#responsive#',
	) );
// Note: You can customize the default HTML header by copying the generic
// /skins/_html_header.inc.php file into the current skin folder.
// -------------------------------- END OF HEADER --------------------------------
?>


<?php
// ------------------------- BODY HEADER INCLUDED HERE --------------------------
skin_include( '_body_header.inc.php' );
// Note: You can customize the default BODY header by copying the generic
// /skins/_body_header.inc.php file into the current skin folder.
// ------------------------------- END OF HEADER --------------------------------
?>


<div id="content" class="widecolumn">

<?php
	// ------------------------- MESSAGES GENERATED FROM ACTIONS -------------------------
	messages( array(
			'block_start' => '<div class="action_messages">',
			'block_end'   => '</div>',
		) );
	// --------------------------------- END OF MESSAGES ---------------------------------
?>

<?php
// Display message if no post:
display_if_empty();

echo '<div id="styled_content_block">'; // Beginning of posts display
while( $Item = & mainlist_get_item() )
{ // For each blog post, do everything below up to the closing curly brace "}"

	if( ! $Item->is_intro() && $Skin->get_setting( 'display_post_date' ) )
	{ // Display only if we're *not* displaying an intro post AND we want to see the date:
		$Item->issue_time( array(
				'before'      => '<div class="post_date"><span>',
				'after'       => '</span></div>',
				'time_format' => 'j. F Y',
				'item_class'  => 'bPost evo_content_block',
			) );
	}

	?>

	<?php
		$Item->locale_temp_switch(); // Temporarily switch to post locale (useful for multilingual blogs)
	?>

	<div id="<?php $Item->anchor_id() ?>" class="post post<?php $Item->status_raw() ?>" lang="<?php $Item->lang() ?>">

		<h1><?php
			$Item->title( array(
					'link_type' => 'permalink'
				) );
		?></h1>
		<?php
			if( $Item->status != 'published' )
			{
				$Item->format_status( array(
						'template' => '<div class="floatright"><span class="note status_$status$"><span>$status_title$</span></span></div>',
					) );
			}
		?>
		<div class="author">
		<?php
			$Item->author( array(
					'before' => '<span>'.T_('By').' ',
					'after'  => '</span>'
				) );

			$Item->edit_link( array( // Link to backoffice for editing
					'before'    => ' &nbsp;',
					'after'     => '',
					'text'      => get_icon( 'edit' ),
				) );
		?>
		</div>
		<?php
			// ---------------------- POST CONTENT INCLUDED HERE ----------------------
			skin_include( '_item_content.inc.php', array(
					'image_size' => 'fit-640x480',
				) );
			// Note: You can customize the default item content by copying the generic
			// /skins/_item_content.inc.php file into the current skin folder.
			// -------------------------- END OF POST CONTENT -------------------------
		?>

		<?php
			// ------------------------- "Item - Single" CONTAINER EMBEDDED HERE --------------------------
			// WARNING: EXPERIMENTAL -- NOT RECOMMENDED FOR PRODUCTION -- MAY CHANGE DRAMATICALLY BEFORE RELEASE.
			// Display container contents:
			skin_container( NT_('Item Single'), array(
					// The following (optional) params will be used as defaults for widgets included in this container:
					// This will enclose each widget in a block:
					'block_start' => '<div class="$wi_class$">',
					'block_end' => '</div>',
					// This will enclose the title of each widget:
					'block_title_start' => '<h3>',
					'block_title_end' => '</h3>',
					// If a widget displays a list, this will enclose that list:
					'list_start' => '<ul>',
					'list_end' => '</ul>',
					// This will enclose each item in a list:
					'item_start' => '<li>',
					'item_end' => '</li>',
					// This will enclose sub-lists in a list:
					'group_start' => '<ul>',
					'group_end' => '</ul>',
					// This will enclose (foot)notes:
					'notes_start' => '<div class="notes">',
					'notes_end' => '</div>',
				) );
			// ----------------------------- END OF "Sidebar" CONTAINER -----------------------------
		?>

		<p class="postmetadata alt">
			<?php
				$Item->author( array(
						'link_text'    => 'only_avatar',
						'link_rel'     => 'nofollow',
						'thumb_size'   => 'crop-top-48x48',
						'thumb_class'  => 'leftmargin',
					) );

				if( $Skin->get_setting( 'display_post_date') )
				{	// We want to display the post date:
					$Item->issue_time( array(
							'before'      => /* TRANS: date */ T_('This entry was posted on '),
							'time_format' => 'j. F Y',
						) );
					$Item->author( array(
							'before'      => T_('by ').' ',
						) );
				}
				else
				{
					$Item->author( array(
							'before'      => T_('This entry was posted by '),
						) );
				}

				$Item->categories( array(
					'before'          => ' '.T_('and is filed under').' ',
					'after'           => '.',
					'include_main'    => true,
					'include_other'   => true,
					'include_external'=> true,
					'link_categories' => true,
				) );

				// List all tags attached to this post:
				$Item->tags( array(
						'before' =>         ' '.T_('Tags').': ',
						'after' =>          ' ',
						'separator' =>      ', ',
					) );

				$Item->edit_link( array( // Link to backoffice for editing
						'before'    => ' ',
						'text'		=> '#icon#',
					) );
			?>
		</p>

	</div>

<?php
	// ------------------- PREV/NEXT POST LINKS (SINGLE POST MODE) -------------------
	item_prevnext_links( array(
			'block_start' => '<div class="prevnext_post"><div>',
			'prev_text' => '<i class="fa fa-chevron-left"></i> &nbsp; $title$',
			'prev_class' => 'prev_post',
			'prev_end'    => '<span class="prevnext_post_separator">&nbsp;</span>',
			'next_text' => '$title$ &nbsp; <i class="fa fa-chevron-right"></i>',
			'next_class' => 'next_post',
			'block_end'   => '</div></div>',
		) );
	// ------------------------- END OF PREV/NEXT POST LINKS -------------------------
?>


	<?php
		// ------------------ FEEDBACK (COMMENTS/TRACKBACKS) INCLUDED HERE ------------------
		skin_include( '_item_feedback.inc.php', array(
				'before_section_title' => '<div class="page_separator"><span>',
				'after_section_title'  => '</span></div>',
			) );
		// Note: You can customize the default item feedback by copying the generic
		// /skins/_item_feedback.inc.php file into the current skin folder.
		// ---------------------- END OF FEEDBACK (COMMENTS/TRACKBACKS) ---------------------
	?>

	<?php
	locale_restore_previous();	// Restore previous locale (Blog locale)
}
echo '</div>'; // End of posts display
?>

</div>


<?php
// ------------------------- BODY FOOTER INCLUDED HERE --------------------------
skin_include( '_body_footer.inc.php' );
// Note: You can customize the default BODY footer by copying the
// _body_footer.inc.php file into the current skin folder.
// ------------------------------- END OF FOOTER --------------------------------
?>


<?php
// ------------------------- HTML FOOTER INCLUDED HERE --------------------------
skin_include( '_html_footer.inc.php' );
// Note: You can customize the default HTML footer by copying the
// _html_footer.inc.php file into the current skin folder.
// ------------------------------- END OF FOOTER --------------------------------
?>
