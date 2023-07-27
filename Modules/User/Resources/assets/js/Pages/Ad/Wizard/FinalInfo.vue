<template>
	<WizardStep
		:backLink="
			route('user.ad.step_phone_contact', {
				ad: ad.slug
			})
		"
	>
		<form @submit.prevent="next">
			<p class="form-title">
				{{ __('ads.wizard.final_info.title') }}
			</p>
			<p class="form-desc">
				{{ __('ads.wizard.final_info.desc') }}
			</p>

			<b-form-group
				:label="__('ads.form.label.details.title')"
				label-for="title"
			>
				<b-form-input
					type="text"
					id="title"
					required
					v-model="form.title"
					:placeholder="__('ads.form.placeholder.details.title')"
				></b-form-input>
				<p class="text-danger" v-text="form.errors.title"></p>
			</b-form-group>

			<b-form-group
				:label="__('ads.form.label.details.description')"
				label-for="description"
				class="ad-description-form"
			>
				<b-form-textarea
					id="description"
					required
					:placeholder="__('ads.form.placeholder.details.description')"
					rows="30"
					v-model="form.description"
				></b-form-textarea>
				<p class="text-danger" v-text="form.errors.description"></p>
			</b-form-group>

			<b-form-group class="text-center mt-4">
				<b-form-checkbox
					v-model="form.agreement_status"
					name="agreement_status"
				>
					قوانین انتشار آگهی را مطالعه کرده ام و مسئولیت عدم رعایت قوانین را بر
					عهده میگیرم.
				</b-form-checkbox>
				<p class="text-danger" v-text="form.errors.agreement_status"></p>
			</b-form-group>

			<b-button variant="secondary" @click.prevent="next">
				{{ __('ads.preview') }}
				<b-icon icon="eye-fill" class="vertical-middle"></b-icon>
			</b-button>
		</form>
	</WizardStep>
</template>

<script>
import WizardStep from '../../../Components/WizardStep'

export default {
	components: {
		WizardStep
	},
	data() {
		return {
			form: this.$inertia.form({
				title: null,
				description: null,
				agreement_status: false
			}),
			ad: this.getProp('ad')
		}
	},
	mounted() {
		this.form.title = this.ad.title
		this.form.description = this.ad.description
	},
	methods: {
		next() {
			if (!this.form.agreement_status) {
				this.$to(
					this.__('ads.form.error.rule.title', 'ads.form.error.rule.desc')
				)
				return 0
			}

			this.form.post(
				route('user.ad.step_phone_details', {
					ad: this.ad.slug
				})
			)
		}
	}
}
</script>
