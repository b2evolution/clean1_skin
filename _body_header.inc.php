<?php
/**
 * This is the BODY header include template.
 *
 * For a quick explanation of b2evo 2.0 skins, please start here:
 * {@link http://manual.b2evolution.net/Skins_2.0}
 *
 * This is meant to be included in a page template.
 *
 * @package evoskins
 * @subpackage clean1
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );


// ---------------------------- SITE HEADER INCLUDED HERE ----------------------------
// If site headers are enabled, they will be included here:
siteskin_include( '_site_body_header.inc.php' );
// ------------------------------- END OF SITE HEADER --------------------------------
?>

<div id="page" class="page">

<div id="header">

	<div class="evo_container evo_container__page_top">
	<?php
		// Display container and contents:
		skin_container( NT_('Page Top'), array(
				// The following params will be used as defaults for widgets included in this container:
				'block_start' => '<div class="evo_widget $wi_class$">',
				'block_end' => '</div>',
				'block_display_title' => false,
				'list_start' => '<ul>',
				'list_end' => '</ul>',
				'item_start' => '<li>',
				'item_end' => '</li>',
			) );
	?>
	</div>

	<?php
	global $hide_widget_container_menu;
	if( empty( $hide_widget_container_menu ) )
	{ // Display this widget container only when it is not disabled
	?>
	<div class="evo_container evo_container__menu">
		<ul>
		<?php
			// ------------------------- "Menu" CONTAINER EMBEDDED HERE --------------------------
			// Display container and contents:
			skin_container( NT_('Menu'), array(
					// The following params will be used as defaults for widgets included in this container:
					'block_start'         => '',
					'block_end'           => '',
					'block_display_title' => false,
					'list_start'          => '',
					'list_end'            => '',
					'item_start'          => '<li class="evo_widget $wi_class$">',
					'item_end'            => '</li>',
					'item_title_before'   => '',
					'item_title_after'    => '',
				) );
			// ----------------------------- END OF "Menu" CONTAINER -----------------------------
		?>
		</ul>
	</div>
	<?php } ?>

	<div class="clear evo_container evo_container__header">
	<?php
		// ------------------------- "Header" CONTAINER EMBEDDED HERE --------------------------
		// Display container and contents:
		skin_container( NT_('Header'), array(
				// The following params will be used as defaults for widgets included in this container:
				'block_start'         => '<div class="evo_widget $wi_class$">',
				'block_end'           => '</div>',
				'block_title_start'   => '<h1>',
				'block_title_end'     => '</h1>',
				'list_start'          => '<div class="menu_top_widget_block">',
				'list_end'            => '</div>',
				'item_start'          => '<span>',
				'item_end'            => '</span> ',
				'item_selected_start' => '<span class="selected">',
				'item_selected_end'   => '</span> ',
				'item_last_start'     => '<span>',
				'item_last_end'       => '</span> ',
				'group_start'         => ' <span class="subitems">(&nbsp;',
				'group_end'           => ' )</span> ',
			) );
		// ----------------------------- END OF "Header" CONTAINER -----------------------------
	?>
	</div>
</div>