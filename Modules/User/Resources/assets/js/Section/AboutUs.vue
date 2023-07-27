<template>
	<AppSection class="about-us">
		<b-container>
			<b-row>
				<b-col md="6">
					<h3>درباره ما بیشتر بدانید</h3>
					<p>
						وبسایت دیوایس‌چی یک پلتفرم تخصصی برای خرید و فروش لوازم الکترونیکی
						میباشد.
					</p>
				</b-col>
				<b-col md="6">
					<div class="vector">
						<img :src="url('images/questions.svg')" alt="about us icon" />
					</div>
				</b-col>
			</b-row>
		</b-container>
	</AppSection>
</template>

<script>
import AppSection from './../Components/AppSection'

export default {
	components: {
		AppSection
	}
}
</script>
