<template>
	<AuthLayout :user="user">
		<section class="payment-section">
			<div class="payment-inner">
				<div class="infos">
					<div class="icon light-green-background green-border-color ">
						<i class="fa fa-check green-color" aria-hidden="true"></i>
					</div>
					<div class="title">موفقیت آمیز</div>
					<div class="message">تراکنش شما با موفقیت انجام شد</div>
					<p>
						<span>کد پیگیری :‌</span>
						<span>{{ refID }}</span>
					</p>
					<p>
						<span>مبلغ کل :‌</span>
						<span>{{ formatMoney(finalPrice) }}</span>
                        <span>ریال</span>
					</p>
					<inertia-link
						:href="
							route('user.ad.step_phone_demo', {
								ad
							})
						"
						class="btn green-background pay-btn"
						>مدیریت آگهی
					</inertia-link>
					<h5 class="mt-4 py-4">لیست موارد خریداری شده برای آگهی مورد نظر:</h5>
					<ul class="list-group">
						<li
							class="list-item"
							v-for="(promotion, index) in promotions"
							:key="index"
						>
							<span v-text="promotion.title"></span>
							<span>{{ formatMoney(promotion.price) }}</span>
							<span>{{ formatCurrency(promotion.currency) }}</span>
						</li>
					</ul>
				</div>
			</div>
		</section>
	</AuthLayout>
</template>

<script>
import AuthLayout from './../../Layouts/FrontAuthLayout'

export default {
	props: ['user', 'refID', 'promotions', 'finalPrice', 'ad'],
	components: {
		AuthLayout
	}
}
</script>
