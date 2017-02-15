<?php
global $term, $wp_query;

global $offset;
$viewd=$_COOKIE['view_mode'];
if($page_mode == 1) {
	$page_mode2=0;
}else if($page_mode == 0) {
	$page_mode2=1;
}

if($viewd == 2){
	$modedtable='text-align: center !important; ';

} 
	
	if( empty($type) ) $type = 'numbers';
	$type2 = is_single() ? 'links' : $type;



$count_posts = wp_count_posts();


if(is_tag()){
		
		$published_posts =  wt_get_category_count(single_tag_title( '', false ));

}else if($search){

	$searchID=$_SESSION['SEARCHID'];
	$published_posts =  count($searchID);

}else if (is_category()){
		
		$cate=$term->cat_ID;
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$ppp = get_option('posts_per_page');
		$page_offset = $offset + ( ($paged -1) * $ppp );
		$wp_query->query('offset='.$page_offset.'&posts_per_page='.$ppp.'&cat='.$cate);
		$published_posts =  wp_get_cat_postcount($cate);

		

	
		
			

}else{

		$published_posts = $count_posts->publish;
	
}


$ppp = get_option('posts_per_page');

$offset2 = $offset + $ppp;
		
if ($offset2 >= $published_posts){

	$offset2 = $offset;
	$javascroll='ya';
	
}else{

	$javascroll=$offset2;
}	

				if (($offset-$ppp) < 0) {
						
					$off = 0;
						
				}else{
						
					$off = ($offset-$ppp);
					
							
				}

				

			if (is_tag()){
				
					$actionp=esc_url( home_url( '/' ).'tag/'.single_cat_title( '', false ).'/?offset='.$off);
					$actionn=esc_url( home_url( '/' ).'tag/'.single_cat_title( '', false ).'/?offset='.$javascroll);
					$actionmode=esc_url( home_url( '/' ).'tag/'.single_cat_title( '', false ).'/?page_mode='.$page_mode2.'&offset='.$offset);
					
					
				}else if (!is_tag() && the_category2() && !is_single() && $search) {
					
					$category = get_the_category();
					$actionp=get_bloginfo('url').'/category/'.$category[0]->category_nicename.'/?q='.$querysd.'&offset='.$off;
					$actionn=get_bloginfo('url').'/category/'.$category[0]->category_nicename.'/?q='.$querysd.'&offset='.$javascroll;
					$actionmode=get_bloginfo('url').'/category/'.$category[0]->category_nicename.'/?q='.$querysd.'&page_mode='.$page_mode2.'&offset='.$offset;
					
				
				}else if($search){
					
					
					$actionp=esc_url( home_url( '/' )).'?q='.$querysd.'&offset='.$off;
					$actionn=esc_url( home_url( '/' )).'?q='.$querysd.'&offset='.$javascroll;
					$actionmode=esc_url( home_url( '/' )).'?q='.$querysd.'&page_mode='.$page_mode2.'&offset='.$offset;
				
				}else if (is_category()){
				
					$WP_PATH = implode("/", (explode("/", $_SERVER['SCRIPT_NAME'], -1)));
					$WP_PATH .= '/category/';
					$resul = str_ireplace($WP_PATH,'',$_SERVER[REQUEST_URI]);
					$resul2 = preg_replace('~[?]offset=[0-9]+~', '', $resul);
					
				
				
					
					$actionp=get_bloginfo('url').'/category/'.$resul2.'?offset='.$off;
					$actionn=get_bloginfo('url').'/category/'.$resul2.'?offset='.$javascroll;
					$actionmode=get_bloginfo('url').'/category/'.$resul2.'?page_mode='.$page_mode2.'&offset='.$offset;
					
					
					
					
					
	
				}else{
					
					
					$actionp=esc_url( home_url( '/' ).'?offset='.$off);
					$actionn=esc_url( home_url( '/' ).'?offset='.$javascroll);
					$actionmode=esc_url( home_url( '/' ).'?page_mode='.$page_mode2.'&offset='.$offset);
					
					
				}

		
?>


<div id="foo">
</div>





<div id="cuanprimero" cuanprimero="<?php echo $offset ?>"></div>


   

<table id="pagination2" border="0" width="100%" cellspacing="1" style="table-layout: fixed;border-collapse: separate;border-spacing: 0px">
	<tr class="pri" id="pri">
		<td align="left" width="200" style="vertical-align:middle;padding-left:21px;">
			<div id="Deviations">
			<?php if ( $javascroll == 'ya' && $offset2 < $published_posts ){if ($offset2 == 0) $offset2 = $published_posts;echo 'Display '.$offset2.' of '.$published_posts;} ?>
			</div>
			
		</td>
		<td align="center" style="vertical-align:middle">
		<?php if ( $javascroll !== 'ya' || $page_mode == 1 ): ?>
			
		<?php if ($page_mode == 0): ?>
		

		<div class="navi" id="navi">
		<a class="load_more Dajaxyno"  href="<?php echo $actionn; ?>">Show More</a>

		<?php if ( $javascroll !== 'ya' || $page_mode == 1 ) : ?>
		
		<span id='cssmenu'>
		
		<ul >
		<li class='active has-sub last'>
			<div class="load_more_config">
            <span class="barra-buttons">
            <span class="bt config"></span>
            </span>
			</div>
		<ul>
		<li class='header'>Type of Pagination:</li>
		<li>
		
		<?php if($page_mode ==1): ?>
		<a href="<?php echo $actionmode; ?>" class="label">
		<?php endif; ?>
			<span class='check'>
			<input type='radio' value='V1' <?php if($page_mode == 0){echo "checked";} ?> name='R1' id='infi'>
			<span class="label">Scrolling infinitely</span>
			</span>
		<?php if($page_mode ==1): ?>
		</a>
		<?php endif; ?>
		
		</li>
		<li>
		
		<?php if($page_mode == 0): ?>
		<a href="<?php echo $actionmode; ?>" class="label">
		<?php endif; ?>
		<span class='check'>
		<input type='radio' value='V1' <?php if($page_mode == 1){echo "checked";} ?> name='R1' id='pages'>
			<span class="label">Click through pages</span>
		</span>
		
		<?php if($page_mode == 0): ?>
		</a>
		<?php endif; ?>		
		
		</li>
		</ul>
		</li>
		</ul>
		</span>		
		
		<?php endif; ?>		

		
		</div>
		


		<?php elseif ($page_mode == 1 && $offset2 < $published_posts): ?>
		

			<div class="pagination">
                <ul class="pages">
                    <li class="prev">
                        
						<?php if($offset == 0): ?>
							
							<a class="disabled" >Previous</a>
						
						<?php else: ?>
						
									
							<a href="<?php echo $actionp; ?>" >Previous</a>
						<?php endif; ?>						
						
						
                    </li>
					
					
	<span id='cssmenu'>
		
		<ul >
		<li class='active has-sub last'>
            <span class="barra-buttons2">
            <span class="bt2 config"></span>
            </span>
		<ul class="segm">
		<li class='header'>Type of Pagination:</li>
		<li>
		
		<?php if($page_mode ==1): ?>
		<a href="<?php echo $actionmode; ?>" class="label">
		<?php endif; ?>
			<span class='check'>
			<input type='radio' value='V1' <?php if($page_mode == 0){echo "checked";} ?> name='R1' id='infi'>
			<span class="label">Scrolling infinitely</span>
			</span>
		<?php if($page_mode ==1): ?>
		</a>
		<?php endif; ?>
		
		</li>
		<li>
		
		<?php if($page_mode == 0): ?>
		<a href="<?php echo $actionmode; ?>" class="label">
		<?php endif; ?>
		<span class='check'>
		<input type='radio' value='V1' <?php if($page_mode == 1){echo "checked";} ?> name='R1' id='pages'>
			<span class="label">Click through pages</span>
		</span>
		
		<?php if($page_mode == 0): ?>
		</a>
		<?php endif; ?>		
		
		</li>
		</ul>
		</li>
		</ul>
		</span>		
					
					
                    <li class="next">
						<?php if($javascroll == 'ya'): ?>
							<a class="disabled" >Next</a>
						<?php else: ?>
							<a href="<?php echo $actionn; ?>">Next</a>
						<?php endif; ?>
                    </li>
                </ul>
            </div>

		<?php endif; ?>



		<?php elseif(($offset+1) <= $published_posts && $published_posts !==0): ?>
		
			
			
		
		<div style="text-align: center;font-size: 18px; font-weight: bold; padding: 30px 0px;color: #D8E4D8;">-- END --</div>
		
		
		<?php endif; ?>
		</td>
		<td align="right" width="200" style="vertical-align:middle;padding-right:21px;">

		</td>
	</tr>
	<tr>
		<td colspan="3">
			
			<div class="contenedor">
			<div id="content3" class="page2" style="<?php echo $modedtable ?>" >
			
			
			</div>
			
			</div>				
		</td>
	</tr>
</table>
