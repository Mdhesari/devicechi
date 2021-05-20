<template>
	<AuthLayout :user="user">
		<section class="single-blog-section">
			<div class="container">
				<div class="single-blog-inner">
					<div class="tumbnail">
						<img
							class="rounded"
							src="https://icdn4.digitaltrends.com/image/digitaltrends/iphone-xr-review-feat.jpg"
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
									<a href="#">
										<i class="fa fa-whatsapp" aria-hidden="true"></i>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-telegram" aria-hidden="true"></i>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-facebook" aria-hidden="true"></i>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-twitter" aria-hidden="true"></i>
									</a>
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
import AuthLayout from './../../Layouts/FrontAuthLayout'

export default {
	props: ['user', 'post'],
	components: {
		AuthLayout
	}
}
</script>
