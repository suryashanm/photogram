<div class="col-lg-3 mb-4" id="post-<?=$p->getID()?>">
	<div class="card">
		<img class="bd-placeholder-img card-img-top"
			src="<?=$p->getImageUri()?>">
		<div class="card-body">
			<p class="card-text"><?=$p->getPostText()?>
			</p>
			<div class="d-flex justify-content-between align-items-center">
				<div class="btn-group" data-id="<?=$p->getID()?>">
					<button type="button" class="btn btn-sm btn-outline-primary btn-like">Like</button>
					<!-- <button type="button" class="btn btn-sm btn-outline-success">Share</button> -->
					<?php
                        if (Session::isOwnerOf($p->getOwner())) {
                            ?>
					<button type="button" class="btn btn-sm btn-outline-danger btn-delete">Delete</button>
					<?}?>
				</div>
				<small class="text-muted"><?=$uploaded_time_str?>
					by
					<?=$owner->getUsername()?></small>
			</div>
		</div>
	</div>
</div>