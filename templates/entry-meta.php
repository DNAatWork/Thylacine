<div class="author-post-meta">

	<ul>
		<li class="comment-content-pipe">
			<a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?= get_the_author(); ?>
			</a>
		</li>
		<li class="comment-content-pipe">
			<i class="fa fa-clock-o">

			</i>
			<time class="updated" datetime="<?= get_post_time('c', true); ?>"><?= get_the_date(); ?></time>
		</li>
				<li class="comment-content-pipe">
		<i class="fa fa-comment"> <?php $commentscount = get_comments_number(); echo $commentscount; ?></i>
		</li>
		<?php $category_ids = get_all_category_ids(); ?> <?php $args = array( 'orderby' => 'slug', 'parent' => 0 ); $categories = get_categories( $args ); foreach ( $categories as $category ) { echo '<li class="comment-content-pipe"><a href="' . get_category_link( $category->term_id ) . '" rel="bookmark"><i class="fa fa-tag"> ' . $category->name . '</i>' . '' . $category->description . '</a>'; } ?> 

	</ul> 

</div>
