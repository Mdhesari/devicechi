<template>
	<authLayout :user="user">
		<section class="wizard">
			<b-container>
				<StepsIndicator :steps="all_steps" :step="step" />
				<!-- Wizard steps -->
				<div class="form-content">
					<div class="card wizard-card">
						<keep-alive>
							<component :step="step" :is="tab" @next="setTab"></component>
						</keep-alive>
					</div>
				</div>
				<!-- End wiazrd steps -->
				<b-alert class="mt-4" variant="secondary" :show="helpAd">
					<p>
						در مراحل ثبت آگهی به مشکل خورده اید؟! از طریق لینک زیر با پشتیبانی
						تماس بگیرید.
					</p>
					<a :href="route('contact-us')" class="btn btn-link" target="_blank">
						<b-icon icon="telephone"></b-icon> تماس با پشتیبانی
					</a>
				</b-alert>
			</b-container>
		</section>
	</authLayout>
</template>

<script>
import AuthLayout from '../../../Layouts/FrontAuthLayout'
import ChooseBrand from './ChooseBrand'
import ChooseModel from './ChooseModel'
import ChooseVariant from './ChooseVariant'
import ChooseAccessory from './ChooseAccessory'
import ChooseAge from './ChooseAge'
import ChoosePrice from './ChoosePrice'
import UploadPictures from './UploadPictures'
import ChooseLocation from './ChooseLocation'
import ChooseContact from './ChooseContact'
import FinalInfo from './FinalInfo'
import StepsIndicator from '../../../Components/StepsIndicator'

export default {
	components: {
		AuthLayout: AuthLayout,
		StepsIndicator: StepsIndicator,
		step_1: ChooseBrand,
		step_2: ChooseModel,
		step_3: ChooseVariant,
		step_4: ChooseAccessory,
		step_5: ChooseAge,
		step_6: ChoosePrice,
		step_7: UploadPictures,
		step_8: ChooseLocation,
		step_9: ChooseContact,
		step_10: FinalInfo
	},
	data() {
		return {
			helpAd: this.getProp('show_help_ad')
		}
	},
	props: ['step', 'all_steps', 'user'],
	computed: {
		tab() {
			return 'step_' + this.step
		}
	},
	methods: {
		setTab() {
			this.step++

			this.tab = 'step_' + this.step
		},
		disbaleHelpAd() {
			axios.put(route('user.api.alerts.disable.ad-help'))
		}
	}
}
</script>
