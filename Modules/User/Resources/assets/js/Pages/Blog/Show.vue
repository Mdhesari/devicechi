<template>
	<AuthLayout :user="user">
		<section class="single-blog-section">
			<div class="container">
				<div class="single-blog-inner">
					<div class="tumbnail">
						<img
							class="rounded"
							:src="post.meta_featured_image_url"
							:alt="post.title"
						/>
					</div>
					<div class="heading mt-4">
						<h1 v-text="post.title"></h1>
						<p class="text-muted">
							<span>آخرین زمان بروزرسانی : </span>
							<span>{{ moment(post.updated_at).format('LL') }}</span>
						</p>
					</div>
					<div class="meta-box">
						<div class="share-box">
							<label>اشتراک گذاری در :</label>
							<ul>
								<li>
									<ShareNetwork
										network="whatsapp"
										:url="
											route('user.blog.show', {
												post: post.slug
											})
										"
										:title="post.title"
										:description="post.excerpt"
									>
										<i class="fa fa-whatsapp" aria-hidden="true"></i>
									</ShareNetwork>
								</li>
								<li>
									<ShareNetwork
										network="telegram"
										:url="
											route('user.blog.show', {
												post: post.slug
											})
										"
										:title="post.title"
										:description="post.excerpt"
									>
										<i class="fa fa-telegram" aria-hidden="true"></i>
									</ShareNetwork>
								</li>
								<li>
									<ShareNetwork
										network="facebook"
										:url="
											route('user.blog.show', {
												post: post.slug
											})
										"
										:title="post.title"
										:description="post.excerpt"
									>
										<i class="fa fa-facebook" aria-hidden="true"></i>
									</ShareNetwork>
								</li>
								<li>
									<ShareNetwork
										network="twitter"
										:url="
											route('user.blog.show', {
												post: post.slug
											})
										"
										:title="post.title"
										:description="post.excerpt"
									>
										<i class="fa fa-twitter" aria-hidden="true"></i>
									</ShareNetwork>
								</li>
							</ul>
						</div>
						<div class="actionBox"></div>
					</div>
					<div class="content" v-html="fixGivenString(post.body)"></div>
				</div>
			</div>
		</section>
	</AuthLayout>
</template>

<script>
import Vue from 'vue'
import AuthLayout from './../../Layouts/FrontAuthLayout'
import ShareNetwork from 'vue-social-sharing'

Vue.use(ShareNetwork)

export default {
	props: ['user', 'post'],
	components: {
		AuthLayout
	}
}
</script>
