<?php get_header(); ?>
	<div id="app">
		<router-view>
		</router-view>
	</div>
<template id="post-list-template">
	<div class="container">
	<div class="spacer"></div>
		<div class="input-group input-group-lg">
			<span class="input-group-addon">Filter by name:</span>
			<input type="text" name="" v-model="nameFilter" class="form-control" placeholder="Search blogs...">
		</div>
		<div class="radio">
			<label class="checkbox-inline">
				<input type="radio" value="" v-model="categoryFilter">All
			</label>
			<label class="checkbox-inline" v-for="category in categories" v-if="category.name != 'Uncategorized'">
				<input type="radio" value="{{ category.id }}" v-model="categoryFilter">{{ category.name }}
			</label>
		</div>
		<div class="spacer"></div>
	</div>
	<div class="container">
		<div class="card-deck-wrapper">
		  <div class="card-deck">
			  <div v-for="post in posts | filterBy nameFilter in 'title' | filterBy categoryFilter in 'categories'" class="col-md-4">
			    <div  class="card">
			      <img class="card-img-top" v-bind:src="post.fi_medium" alt="Card image cap">
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
</template>
<?php get_footer(); ?>
