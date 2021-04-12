<template>
	<AuthLayout :user="user">
		<section class="single-blog-section">
			<div class="container">
				<div class="single-blog-inner">
					<div class="heading">
						<h1 v-text="page.title"></h1>
					</div>
					<div class="content" v-html="page.body"></div>
				</div>
			</div>
		</section>
	</AuthLayout>
</template>

<script>
import AuthLayout from './../../Layouts/FrontAuthLayout'

export default {
	props: ['user', 'page'],
	components: {
		AuthLayout
	}
}
</script>
