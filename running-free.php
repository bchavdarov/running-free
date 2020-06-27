<?php
/**
 * @package Runing_free
 * @version 2.0.1
 */
/*
Plugin Name: Iron Maiden - Running free
Plugin URI: https://github.com/bchavdarov/running-free
Description: "Running Free" is the debut single by Iron Maiden, released on 8 February 1980 on the 7" 45 rpm vinyl record format. It was written by Steve Harris and Paul Di'Anno. The song appears as the third track on the band's debut album Iron Maiden (and the fourth track on its 1998 re-release). In 1985, a live version of the song was released as the first single from Live After Death (the band's twelfth single). When activated you will randomly see a lyric from <cite>Running free</cite> in the upper right of your admin screen on every page.
Author: Boncho Chavdarov
Version: 2.0.3
Author URI: https://bchavdarov.github.io/bcdlab/
*/

function running_free_get_lyric() {
	/** Here is the lyrics of Running free */
	$lyrics = "Just sixteen, a pickup truck
Out of money, out of luck
I've got nowhere to call my own
Hit the gas, and here I go
I'm running free yeah
I'm running free
I'm running free yeah
I'm running free
Spent the night in an L. A. jail
And listened to the sirens wail
They ain't got a thing on me
I'm running wild, I'm running free
I'm running free yeah
I'm running free
I'm running free yeah
I'm running free
Get out of my way
I'm running free yeah
I'm running free
I'm running free yeah
I'm running free Right?
Puller here at the Bottle Top
Whiskey, dancing, disco hop
Now all the boys are after me
And that's the way it's gonna be
I'm running free yeah
I'm running free
I'm running free yeah
I'm running free
Oh, I'm running free yeah
I'm running free
I'm running free yeah
I'm running free";

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function running_free() {
	$chosen = running_free_get_lyric();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="maiden"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__( 'Quote from Running free song, by Iron Maiden:' ),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'running_free' );

// We need some CSS to position the paragraph.
function maiden_css() {
	echo "
	<style type='text/css'>
	#maiden {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
		color: #6495ED;
		/*cornflower blue*/
	}
	.rtl #maiden {
		float: left;
	}
	.block-editor-page #maiden {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#maiden,
		.rtl #maiden {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'maiden_css' );
