<template>
	<AppSection class="blog-lists py-5">
		<b-container>
			<div class="main-title">
				<h2>
					آخرین مطالب
				</h2>
			</div>
			<b-row class="blogs">
				<BlogItem
					v-for="(post, index) in posts"
					:key="index"
					:post="post"
				></BlogItem>
				<div class="more">
					<a :href="route('user.blog.index')">
						مشاهده بیشتر
						<i class="fa fa-arrow-left" aria-hidden="true"></i>
					</a>
				</div>
			</b-row>
		</b-container>
	</AppSection>
</template>

<script>
import AppSection from './../Components/AppSection'
import BlogItem from './../Components/BlogItem'

export default {
	components: {
		AppSection,
		BlogItem
	},
	props: ['posts']
}
</script>
