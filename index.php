<?php get_header(); ?>
	<div class="white-wrap">
		<div id="app">
			<router-view>
			</router-view>
		</div>
	</div>


<template id="post-list-template">
<div class="overlay" v-if="show" transition="overlayshow"></div>
<div class="container">
	<header class="main-header">
		<img src="<?php bloginfo('template_url'); ?>/images/hero.jpg" alt="" class="hero">
	</header>
	<div class="filter-bar">
		<a v-on:click="openFilter" v-if="filterBtnOpen" class="btn btn-success"><i class="fa fa-filter" aria-hidden="true"></i> Open Filter</span></a>
		<a v-on:click="closeFilter" v-if="filterBtnClose" class="btn btn-danger"><i class="fa fa-filter" aria-hidden="true"></i> Close Filter</span></a>
		<div class="filter-wrap" v-if="showFilter" transition="filter">
			<div class="container">
				<div class="input-group input-group-lg">
					<span class="input-group-addon">Filter by name:</span>
					<input type="text" name="" v-model="nameFilter" class="form-control" placeholder="Search blogs...">
				</div>
				<div class="spacer"></div>
				<div class="radio col-md-8 col-md-offset-2">
					<label class="checkbox-inline">
						<input type="radio" value="" v-model="categoryFilter">All
					</label>
					<label class="checkbox-inline" v-for="category in categories" v-if="category.name != 'Uncategorized'">
						<input type="radio" value="{{ category.id }}" v-model="categoryFilter">{{ category.name }}
					</label>
				</div> <!-- radio -->
			</div>
		</div> <!-- filter-wrap -->
	</div> <!-- filter-bar -->
		<div class="card-deck-wrapper">
		  <div class="card-deck">
			  <div v-for="post in posts | filterBy nameFilter in 'title' | filterBy categoryFilter in 'categories'" class="col-md-4">
			    <div  class="card">
			      <a v-on:click="getThePost(post.id)"><img class="card-img-top" v-bind:src="post.fi_medium" alt="Card image cap"></a>
			      <div class="card-block">
			        <h4 class="card-title">{{post.title.rendered}}</h4>
			        <!-- <p class="card-text">{{post.excerpt.rendered}}</p> -->
			        <p class="card-text"><small v-for="category in post.cats" class="label label-default">{{ category.name }} </small></p>
			      </div>
			    </div>
			  </div>
		  </div>
		</div>
	</div>

	<div class="single-preview" v-if="show" transition="postshow">
		<h2>{{ post[0].title.rendered }}</h2>
		<div class="image"><img v-bind:src="post[0].full"></div>
		<div class="post-content">
			{{{ post[0].excerpt.rendered }}}
			<button v-link="{name:'post', params:{postID: post[0].id}}" class="btn btn-success">Read More</button>
		</div>
		<a v-on:click="getThePost(post[0].next_post)" v-if="post[0].next_post" class="post-nav next"><i class="fa fa-arrow-circle-right fa-3x" aria-hidden="true"></i></a>
		<a v-on:click="getThePost(post[0].prev_post)" v-if="post[0].prev_post" class="post-nav prev"><i class="fa fa-arrow-circle-left fa-3x" aria-hidden="true"></i></a>
		<button v-on:click="closePost" class="close-button">&times;</button>
	</div>
</template>

<template id="single-post-template">
<div class="post-control">
	<div class="container">
		<a class="btn btn-success" v-link="{path: '/'}">Back to post list</a>
	</div>
	<a v-link="{ name: 'post', params: { postID: post.next_post}}" v-if="post.next_post" class="post-nav next"><i class="fa fa-arrow-circle-right fa-3x" aria-hidden="true"></i></a>
	<a v-link="{ name: 'post', params: { postID: post.prev_post}}" v-if="post.prev_post" class="post-nav prev"><i class="fa fa-arrow-circle-left fa-3x" aria-hidden="true"></i></a>
</div>
	<div class="container single-post">
		<h2>{{ post.title.rendered}}</h2>
		<div class="image"><img v-bind:src="post.full" alt=""></div>
		<div class="post-content">{{{ post.content.rendered }}}</div>
	</div>
</template>

<?php get_footer(); ?>
