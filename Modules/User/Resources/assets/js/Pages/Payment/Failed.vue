<template>
	<AuthLayout :user="user">
		<section class="payment-section">
			<div class="payment-inner">
				<div class="infos">
					<div class="icon ligh-red-background red-border-color">
						<i class="fa fa-times red-color" aria-hidden="true"></i>
					</div>
					<div class="title">خطا</div>
					<div class="message">{{ message }}</div>
					<inertia-link
						:href="
							route('user.ad.step_phone_promote', {
								ad
							})
						"
						class="btn red-background pay-btn"
						>دوباره تلاش کنید!</inertia-link
					>
				</div>
			</div>
		</section>
	</AuthLayout>
</template>

<script>
import AuthLayout from './../../Layouts/FrontAuthLayout'

export default {
	props: ['user', 'ad', 'message'],
	components: {
		AuthLayout
	}
}
</script>
