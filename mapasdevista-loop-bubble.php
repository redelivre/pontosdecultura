<?php
if(array_key_exists('offset', $_POST))
{
	$posts = mapasdevista_get_posts(1, $mapinfo, array('posts_per_page' => 500, 'offset' => $_POST['offset']));
	if(!$posts->have_posts())
	{
		echo 0;
	}
	while($posts->have_posts()): $posts->the_post(); ?>
	<div id="balloon_<?php the_ID(); ?>" class="result clearfix">
	    <div class="balloon">
	        
	        <div class="content">
	            <h1 class="bottom"><a class="js-link-to-post" id="balloon-post-link-<?php the_ID(); ?>" href="<?php the_permalink(); ?>" onClick="mapasdevista.linkToPost(this); return false;"><?php the_title(); ?></a></h1>
	            <div class="balloon-state-city">
		            <?php
		            $uf = false;
		            $cidade = false;
		            $territorios = wp_get_post_terms(get_the_ID(), 'territorio');
		            foreach ($territorios as $territorio)
		            {
		            	if($territorio->parent == 0) // Estado
		            	{
		            		$uf = $territorio->name;
		            	}
		            	else
		            	{
		            		$cidade = $territorio->name;
		            	}
		            }
		            if($cidade)
		            {
		            	?>
						<span class="balloon-city"><?php echo $cidade; ?> </span>
						<?php
		            }
		            if($uf)
		            {
		            	?>
						<span class="balloon-sep">&ndash;</span> <span
							class="balloon-uf"><?php echo $uf; ?> </span>
						<?php
				    }
				    ?>
			    </div>
	            <?php mapasdevista_get_template( 'mapasdevista-bubble', get_post_format() ); ?>
	        </div>
	    </div>
	</div>
	<?php endwhile;
}
else
{?>
	<div id="mapasdevista_load_bubbles" class="hide">
	<?php $posts = mapasdevista_get_posts(1, $mapinfo); ?>
	<?php while($posts->have_posts()): $posts->the_post(); ?>
	<div id="balloon_<?php the_ID(); ?>" class="result clearfix">
	    <div class="balloon">
	        
	        <div class="content">
	            <!--
	            <p class="metadata bottom">
	                <span class="date"><?php the_time( get_option('date_format') ); ?></span>
	            </p>
	            -->
	            <h1 class="bottom"><a class="js-link-to-post" id="balloon-post-link-<?php the_ID(); ?>" href="<?php the_permalink(); ?>" onClick="mapasdevista.linkToPost(this); return false;"><?php the_title(); ?></a></h1>
	            <?php mapasdevista_get_template( 'mapasdevista-bubble', get_post_format() ); ?>
	        </div>
	    </div>
	</div>
	<?php endwhile; ?>
	</div>
	<?php 	
}
