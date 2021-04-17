<template>
	<authLayout :user="user">
		<section class="wizard">
			<b-container>
				<!-- Wizard steps -->
				<div class="form-content">
					<div class="card wizard-card">
						<div class="card-body rtl text-right wizard-step">
							<form @submit.prevent="next">
								<p class="form-title">
									{{ __('ads.wizard.power.title') }}
								</p>
								<p class="form-desc">
									{{ __('ads.wizard.power.desc') }}
								</p>
							</form>
						</div>
					</div>
				</div>
			</b-container>
		</section>
	</authLayout>
</template>

<script>
import AuthLayout from '../../Layouts/FrontAuthLayout'

export default {
	components: {
		AuthLayout
	},
	props: ['ad', 'user']
}
</script>
