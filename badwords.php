<?php

/*

Plugin name: Bad Words Plugin
Author: Shuhrat
Version: 1.0
Description: This plugin is used to hide forbidden words in text!

*/

add_action('admin_head','true_colored_admin_bar_72aee6');

function true_colored_admin_bar_72aee6(){
	echo'<style>#wpadminbar(background-color:#72aee6;}</style>';
}


// register_activation_hook(_FILE_,'true_activate');

// function true_activate(){

// }



define('BADWORDS_DIR', plugin_dir_path(__FILE__));

function badwords_filter_the_content($the_content)
{
	static $badwords = array();

    if(empty($badwords) )
    {
    	$badwords = explode(',', file_get_contents(BADWORDS_DIR . 'bad-words.txt'));
    }
        
    for( $i = 0, $c = count($badwords); $i < $c; $i ++ ) 
    {
    	$the_content = preg_replace('#'.$badwords[$i].'#iu','{Bad word}', $the_content);
    }
        
    return $the_content;
}




add_filter('the_content','badwords_filter_the_content');