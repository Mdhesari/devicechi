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
					<a href="#" class="btn green-background pay-btn">مدیریت آگهی</a>
                    <h5>لیست موارد خریداری شده : </h5>
					<ul class="list-group">
						<li
							class="list-item"
							v-for="(promotion, index) in promotions"
							:key="index"
							v-text="promotion.title"
						></li>
					</ul>
				</div>
			</div>
		</section>
	</AuthLayout>
</template>

<script>
import AuthLayout from './../../Layouts/FrontAuthLayout'

export default {
	props: ['user', 'refID', 'promotions'],
	components: {
		AuthLayout
	}
}
</script>
