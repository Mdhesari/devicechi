<template>
	<WizardStep
		:backLink="
			route('user.ad.step_phone_age', {
				ad: ad.slug
			})
		"
	>
		<form @submit.prevent="next">
			<p class="form-title">
				{{ __('ads.wizard.choose_price.title') }}
			</p>
			<p class="form-desc">
				{{ __('ads.wizard.choose_price.desc') }}
			</p>

			<b-form-group
				id="input-group-1"
				:label="__('ads.form.label.price')"
				label-for="phone-price"
			>
				<b-form-input
					:disabled="isLoading"
					id="phone-price"
					v-model="form.price"
					type="text"
					required
					maxlength="10"
					@keyup="calculatePrice"
					:placeholder="__('ads.form.placeholder.price')"
				></b-form-input>
				<p class="text-danger" v-text="form.errors.price"></p>
				<p class="form-text text-muted" v-text="calculated_price"></p>
			</b-form-group>

			<b-form-group class="text-center mt-4">
				<b-form-checkbox
					id="is_exchangeable"
					v-model="form.is_exchangeable"
					name="is_exchangeable"
				>
					{{ __('ads.form.label.exchangeable') }}
				</b-form-checkbox>
			</b-form-group>

			<b-button
				v-if="Number(form.price) ? form.price > 0 : false"
				variant="secondary"
				@click.prevent="next"
				:disabled="isInvalid"
			>
				{{ __('global.next') }}
			</b-button>
		</form>
	</WizardStep>
</template>

<script>
import WizardStep from '../../../Components/WizardStep'
import { NumberToWords } from 'persian-tools2'

export default {
	components: {
		WizardStep
	},
	data() {
		return {
			isLoading: false,
			form: this.$inertia.form({
				price: this.formatPrice(this.getProp('price')),
				is_exchangeable: Boolean(this.getProp('is_exchangeable'))
			}),
			isInvalid: false,
			calculated_price: this.calculatePrice(this.getProp('price'), true),
			ad: this.getProp('ad')
		}
	},
	updated() {
		this.isLoading = false
	},
	methods: {
		next(ev) {
			this.isLoading = true
			this.form.post(
				route('user.ad.step_phone_price', {
					ad: this.ad.slug
				}),
				{
					preserveState: false,
					preserveScroll: true
				}
			)

			// this.$emit("next");
		},
		formatPrice(price, dec) {
			if (price.length < 1) return price

			return (price = Math.abs(price).toFixed(dec || 0))
		},
		calculatePrice(price = null, getPrice = false) {
			if (isNaN(price)) {
				price = this.form.price
			}
			price = this.fixGivenNumber(price)
			if (Number(price) > 0) {
				price = this.formatPrice(price)
				if (price.length > 10) {
					this.isInvalid = true
					this.calculated_price = this.__('ads.form.error.price.invalid')
					return 0
				}

				this.isInvalid = false

				let result = this.formatMoney(price) + ' تومان'

				if (getPrice) {
					return NumberToWords.convert(result) + ' تومان'
				}

				this.calculated_price = NumberToWords.convert(result) + ' تومان'
			} else {
				this.calculated_price = ''
				if (this.form) this.form.price = ''
			}
		}
	}
}
</script>
