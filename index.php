<?php get_header(); ?>
	<div id="app">
		<router-view>
		</router-view>
	</div>
<template id="post-list-template">
	<div class="container">
		<!-- <div class="card-deck-wrapper"> -->
		  <div class="card-columns">
			  <div v-for="post in posts"class="col-md-4">
			    <div  class="card">
			      <img class="card-img-top" data-src="..." alt="Card image cap">
			      <div class="card-block">
			        <h4 class="card-title">{{post.title.rendered}}</h4>
			        <p class="card-text">{{post.excerpt.rendered}}</p>
			        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
			      </div>
			    </div>
			  </div>
		  </div>
		<!-- </div> -->
	</div>
</template>
<?php get_footer(); ?>
