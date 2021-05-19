<template>
	<authLayout :user="user">
		<div class="page-title-container">
			<div class="container">
				<h1 class="page-title">آموزش و مطالب</h1>
			</div>
		</div>
		<section class="blog-lists">
			<div class="container">
				<div class="main-title">
					<h3>
						آخرین مطالب
					</h3>
				</div>
				<div class="row blogs">
					<BlogItem
						v-for="(post, index) in posts.data"
						:key="index"
						:post="post"
					></BlogItem>
				</div>

				<Pagination
					size="default"
					align="center"
					:data="posts"
					@pagination-change-page="getResults"
				></Pagination>
			</div>
		</section>
	</authLayout>
</template>

<script>
import AuthLayout from '../../Layouts/FrontAuthLayout'
import Pagination from 'laravel-vue-pagination'
import BlogItem from '../../Components/BlogItem'

export default {
	components: {
		AuthLayout,
		Pagination,
		BlogItem
	},
	props: ['posts', 'user'],
	methods: {
		getResults(page = 1) {
			axios
				.get(
					route('user.blog.index', {
						page
					})
				)
				.then((response) => {
					this.posts = response.data
				})
		}
	}
}
</script>
