<template>
	<article class="col-lg-4 col-md-6 col-sm-12 blog">
		<div class="inner">
			<a
				:href="
					route('user.blog.show', {
						post
					})
				"
				class="fulllink"
			></a>
			<div
				class="thumbnail"
				v-bind:style="{
					backgroundImage: 'url(' + post.meta_featured_image_url + ')'
				}"
			></div>
			<div class="details">
				<div class="title">
					<h3 class="mt-3" v-text="post.title"></h3>
				</div>
				<div class="meta-holder">
					<span class="date" v-text="moment(post.created_at).fromNow()"></span>
					<span class="time-duration">
						<i class="fa fa-clock-o" aria-hidden="true"></i>
						خواندن : {{ minutesToRead }} دقیقه
					</span>
				</div>
				<div class="desc">
					<p v-text="post.excerpt"></p>
				</div>
			</div>
		</div>
	</article>
</template>

<script>
export default {
	props: ['post'],
	data() {
		return {
			styleObject: {
				'background-image': this.post.meta_featured_image_url
			}
		}
	},
	computed: {
		minutesToRead() {
			return this.calcReadTime(this.post.body)
		}
	},
	methods: {
		calcReadTime(text) {
			const wpm = 225
			const words = text.trim().split(/\s+/).length
			const time = Math.ceil(words / wpm)
			return time
		}
	}
}
</script>
