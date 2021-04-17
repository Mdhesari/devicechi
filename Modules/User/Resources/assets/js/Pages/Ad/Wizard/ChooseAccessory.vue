<template>
	<WizardStep
		:backLink="
			route('user.ad.step_phone_model_variant', {
				ad: ad.slug,
				phone_model: model.name
			})
		"
	>
		<form @submit.prevent="next">
			<p class="form-title">
				{{ __('ads.wizard.choose_accessory.title') }}
			</p>
			<p class="form-desc">
				{{ __('ads.wizard.choose_accessory.desc') }}
			</p>

			<div class="row list-accessories mobile-radio-form">
				<b-form-checkbox
					:disabled="isLoading"
					class="col-12 col-md-3 text-center"
					v-for="(accessory, index) in accessories"
					:key="accessory.id"
					:name="'accessory_' + accessory.id"
					v-model="selected[accessory.id]"
					:value="accessory.id"
				>
					<img
						class="accessory-image"
						:src="url(accessory.picture_path)"
						:alt="accessory.title"
					/>
					<h5 class="accessory-title mt-2">
						{{ __('accessories.' + accessory.title) }}
					</h5>
				</b-form-checkbox>
			</div>

			<b-button variant="secondary" @click.prevent="next">
				{{ __('global.next') }}
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
			isLoading: false,
			selected: this.getProp('selected'),
			accessories: this.getProp('accessories'),
			model: this.getProp('phone_model'),
			ad: this.getProp('ad')
		}
	},
	mounted() {
		// this.selected = this.getProp("selected_accessories");
	},
	methods: {
		next() {
			// this.$emit("next");

			this.isLoading = true

			this.$inertia.post(
				route('user.ad.step_phone_accessories', {
					ad: this.ad.slug
				}),
				{
					accessories: this.selected
				},
				{
					preserveState: false,
					onSuccess: (response) => {
						this.isLoading = false
					},
					onError: (response) => {
						this.isLoading = false
					}
				}
			)
		}
	}
}
</script>
