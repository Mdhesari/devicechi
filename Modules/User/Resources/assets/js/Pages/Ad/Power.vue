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

								<div class="row list-accessories mobile-radio-form">
									<b-form-checkbox
										:disabled="isLoading"
										class="col-12 col-md-3 text-center"
										v-for="(feature, index) in features"
										:key="index"
										:name="'feature_' + feature.id"
										v-model="selected[feature.id]"
										:value="feature.id"
									>
										<h5 class="accessory-title mt-2">
											<!-- {{ __('features.' + accessory.title) }} -->
											Feature {{ feature.id }}
										</h5>
									</b-form-checkbox>
								</div>

								<div class="text-center">
									<p>قابل پرداخت :</p>
									<p class="final-price">0 تومان</p>
								</div>

								<button class="btn btn-secondary" type="submit">
									{{ __('ads.proceed') }}
								</button>
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
	props: ['ad', 'user'],
	data() {
		return {
			finalPrice: this.getProp('finalPrice', 0),
			features: this.getProp('features', []),
			selected: this.getProp('selected', [])
		}
	},
	methods: {
		next() {
			//
		}
	}
}
</script>
