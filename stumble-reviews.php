<?php
/*
Plugin Name: stumble-reviews
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

function wp_stumble_review_template()
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
					<h2 id="comments"> Stumble Reviews 	</h2>
					
					
					<ol id="commentlist">
					
					<?php for($i=0;$i<$number;$i++){  ?>
						<li id="comment-<?php echo $i?>">
						<?php echo $array["item"]["description"][$i] ?>
						<p><cite>Review on &#8212; <?php echo date("F j, Y, g:i a", strtotime($array["item"]["pubdate"][$i]) ) ?>   </cite> </p>
						</li>
					
					<?php } ?>
					
					</ol>
					
					<span style= "float:right"><font size="1"><a href="http://www.sajithmr.me/stumble-reviews-wordpress-plugin/">Plugin</a> powered by <a href="http://www.stumblecult.com">StumbleCult</a></font></span>


	<?php endif; ?>
	<?php

} // single if	
}

function simple_sumble_review_template()
{
if ( is_single())
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
					<h4 > Stumble Reviews 	</h4>
					
					
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


} //if single
}

function stumble_review_option() 
{
	?>
<h1><font color="#999999">What I have to Do ?</font></h1>
<p>If you are not using widgets, use <font color="#FF0000"><strong>&lt;?php</strong></font><strong> 
  wp_stumble_review_template()</strong> <font color="#FF0000"> <strong>?&gt;</strong></font> 
  anywhere to show your stumble reviews. Normally in single.php just above your 
  comments template &lt;?php comments_template(); ?&gt;</p>
<p>And for sidebar, you can use <strong><font color="#FF0000">&lt;?php </font>simple_sumble_review_template()<font color="#FF0000"> 
  ?&gt;</font></strong></p>
  
<p>If you are using widget , just activate the <strong>Stumble Review Widget </strong>plugin, 
  and add widget to your blog sidebar. </p>
<p><em><font color="#666666">Remember , stumble reviews are only for single posts. 
  Browse any of your post and see its stumble reviews (if any). If there is no 
  stumble reviews, the widget wont appear there.</font></em></p>
<p><em><font color="#666666">For any queries mail: admin.sajithmr@googlemail.com</font></em></p>
<p><em><font color="#666666">Visit: <a href="http://www.sajithmr.me">www.sajithmr.me</a></font></em></p>
<p><strong></strong></p>
<p> 
  <?php
}
function stumble_review_add_admin()
{
	add_options_page('StumbleReviews', 'StumbleReviews', 4, 'stumblereviews', 'stumble_review_option');
}
add_action('admin_menu', 'stumble_review_add_admin');

?>