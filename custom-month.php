<?php
/*
Plugin Name: Custom Month
Plugin URI: http://wordpress.org/extend/plugins/custom-month/
Description: Custom Post Month Display
Version: 0.1.0
Author: catge
Author URI: http://yekai.net/
*/

if (!class_exists("CustomMonth")){
	class CustomMonth{
		function CustomMonth(){
			
		}
		function getMonth($index = 1){
			$months = array('壹','贰','叁','肆','伍','陆','柒','捌','玖','拾','拾壹','拾贰');
			return $months[$index - 1];
		}
		function filterMonth($the_time,$d = '', $post = null) {
			$month_tags = array('m','n','F','M');
			if ('' == $d){
				$d = get_option('time_format');
			}
			foreach ($month_tags as $month_tag) {
				if(strrpos($d,$month_tag) > -1){
					$replace = $this -> getMonth(intval(get_post_time('n', false, $post, true)));
					$the_time = str_replace(get_post_time($month_tag, false, $post, true),$replace,get_post_time($d, false, $post, true));		
				}
			}
			return $the_time;
		}
	}
}

if (class_exists("CustomMonth")){
	$CustomMonthPlugin = new CustomMonth();
}

if (isset($CustomMonthPlugin)){
	add_filter('the_time',array(&$CustomMonthPlugin, 'filterMonth'),10,3);
}
	
?>
