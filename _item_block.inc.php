<?php
/**
 * This is the template that displays the item block
 *
 * This file is not meant to be called directly.
 * It is meant to be called by an include in the main.page.php template (or other templates)
 *
 * b2evolution - {@link http://b2evolution.net/}
 * Released under GNU GPL License - {@link http://b2evolution.net/about/license.html}
 * @copyright (c)2003-2012 by Francois Planque - {@link http://fplanque.com/}
 *
 * @package evoskins
 * @subpackage clean1
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );

global $Item;

// Default params:
$params = array_merge( array(
		'feature_block'      => false,
		'content_mode'       => 'auto',		// 'auto' will auto select depending on $disp-detail
		'item_class'         => 'post',
		'image_size'         => 'fit-640x480',
		'excerpt_image_size' => 'fit-640x480',
	), $params );

?>
<div id="<?php $Item->anchor_id() ?>" class="<?php $Item->div_classes( $params ) ?>" lang="<?php $Item->lang() ?>">

	<?php
		$Item->locale_temp_switch(); // Temporarily switch to post locale (useful for multilingual blogs)
	?>

	<?php
		if( (!$Item->is_intro()) && $Skin->get_setting( 'display_post_date') )
		{	// Display only if we're *not* displaying an intro post AND we want to see the date:
			$Item->issue_time( array(
					'before'      => '<div class="post_date"><span>',
					'after'       => '</span></div>',
					'time_format' => 'j. F Y',
				) );	
		}

		$Item->edit_link( array( // Link to backoffice for editing
				'before'    => '<div class="floatright">',
				'after'     => '</div>',
				'text'		=> '#icon#',
			) );
	?>

	<h2>
		<?php $Item->title(); ?>
	</h2>

	<?php
		if( $Item->status != 'published' )
		{
			$Item->format_status( array(
					'template' => '<div class="floatright"><span class="note status_$status$"><span>$status_title$</span></span></div>',
				) );
		}

		// ---------------------- POST CONTENT INCLUDED HERE ----------------------
		skin_include( '_item_content.inc.php', $params );
		// Note: You can customize the default item content by copying the generic
		// /skins/_item_content.inc.php file into the current skin folder.
		// -------------------------- END OF POST CONTENT -------------------------
	?>
	
</div>

<?php
locale_restore_previous();	// Restore previous locale (Blog locale)
?>