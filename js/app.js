var App = Vue.extend({});

var postList = Vue.extend({
	template: '#post-list-template',
	data: function(){
		return {
			post: '',
			posts: '',
			categories: '',
			nameFilter: '',
			categoryFilter: '',
			showFilter: false,
			filterBtnOpen: true,
			show: false,
		};
	},
	ready: function(){
		posts = this.$resource('/wp-json/wp/v2/posts?per_page=20');
		categories = this.$resource('/wp-json/wp/v2/categories');
		posts.get(function(posts){
			this.$set('posts',posts);
		});
		categories.get(function(categories){
			this.$set('categories',categories);
		});
	},
	methods: {
		getThePost: function(id){
			var posts = this.posts;
			this.$set('show',true);

			function filterPosts(el){
				return el.id == id;
			}
			this.$set('post', posts.filter(filterPosts));
		},
		openFilter: function(){
			this.$set('showFilter', true);
			this.$set('filterBtnOpen', false);
			this.$set('filterBtnClose', true);
		},
		closeFilter: function(){
			this.$set('showFilter', false);
			this.$set('filterBtnOpen', true);
			this.$set('filterBtnClose', false);
		},
		closePost: function(){
			this.$set('show', false);
		},

	}
});

var singlePost = Vue.extend({
	template: '#single-post-template',
	route: {
		data: function(){
			this.$http.get('/wp-json/wp/v2/posts/' + this.$route.params.postID, function(post){
				this.$set('post', post);
			});
		}
	}

});
var router = new VueRouter();

router.map({
	'/': {
		component: postList
	},
	'post/:postID':{
		name: 'post',
		component: singlePost
	}
});

router.start(App, '#app');
