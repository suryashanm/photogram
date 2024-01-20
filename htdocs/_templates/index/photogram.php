<div class="album py-5 bg-light">
	<div class="container">
		<h3 id="total-posts">Total Posts: N/A</h3>
		<!-- data-masonry='{"percentPosition": true }' -->
		<div class="row" id="masonry-area">
			<?php
                $posts = Post::getAllPosts();
			use Carbon\Carbon;

			foreach ($posts as $post) {
			    $p = new Post($post['id']);
			    $uploaded_time = Carbon::parse($p->getUploadedTime());
			    $uploaded_time_str = $uploaded_time->diffForHumans();
			    $owner = new User($post['owner']);

			    Session::loadTemplate('index/photocard', [
			        'p' => $p,
			        'uploaded_time_str' => $uploaded_time_str,
			        'owner' => $owner
			    ]);
			}
			?>
		</div>
	</div>
</div>