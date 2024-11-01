<?php
/*
Plugin Name: stumble-reviews-widget
Plugin URI: http://www.sajithmr.com/stumble-reviews-wordpress-plugin/
Description: Shows your stumble reviews just below each post
Version: 1.0
Author: Sajith
Author URI: http://www.sajithmr.com
*/


/*  Copyright 2008  AddToThis  (email : mrsajith@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function stumble_review_widget_init()
{
	if (!function_exists('register_sidebar_widget')) {
		return;
	}


function widget_stumble_review()
{

	if(is_single())
	{
	include_once("feedReader.inc.php");
	$ob=new feedReader();
	
	$url=  'http://'. $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ;
	
	
	
	$ob->setFeedUrl("http://www.stumbleupon.com/reviews.php?url=".$url);
	$ob->parseFeed();
	$array=$ob->getFeedOutputData();
	$number=$ob->getFeedNumberOfNodes();
	
	?>
	
	<?php if( $number != 0 ):?>
					
					
					
					<h3 > Stumble Reviews 	</h3>
					
					
				
					
					<ul>
					
					<?php for($i=0;$i<$number;$i++){  ?>
						<li id="comment-<?php echo $i?>">
						<?php echo $array["item"]["description"][$i] ?>
						<p><cite>Review on &#8212; <?php echo date("F j, Y, g:i a", strtotime($array["item"]["pubdate"][$i]) ) ?>   </cite> </p>
						</li>
					
					<?php } ?>
					</ul>
					
					<span style= "float:right"><font size="1"><a href="http://www.sajithmr.me/stumble-reviews-wordpress-plugin/">Plugin</a> powered by <a href="http://www.stumblecult.com">StumbleCult</a></font></span>

	<?php endif; ?>
	<?php
	
	


} // if single 
}



register_sidebar_widget(array('Stumble Reviews', 'wp-stumble-reviews'), 'widget_stumble_review');

}


add_action('plugins_loaded', 'stumble_review_widget_init');
?>