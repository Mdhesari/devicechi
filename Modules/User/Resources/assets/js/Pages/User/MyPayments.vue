<template>
	<AuthLayout :user="user">
		<Panel :user="user" :tabs="tabs">
			<div class="row" v-if="payments.data.length > 0">
				<!-- <div class="col-md-6"></div> -->
				<b-table striped hover :items="payments.data"></b-table>
			</div>

			<!-- No Content -->
			<b-alert
				:show="payments.data.length < 1"
				variant="info"
				class="text-center mt-4"
			>
				شما هیچ پرداختی ندارید!
			</b-alert>

			<Pagination
				size="default"
				align="center"
				:data="payments"
				@pagination-change-page="getResults"
			></Pagination>
		</Panel>
	</AuthLayout>
</template>

<script>
import AuthLayout from '../../Layouts/FrontAuthLayout'
import Panel from '../../Section/Dashboard/Panel'
import Pagination from 'laravel-vue-pagination'

export default {
	components: {
		Panel,
		AuthLayout,
		Pagination
	},
	props: ['user', 'tabs'],
	data() {
		return {
			payments: this.getProp('payments')
		}
	},
	methods: {
		getResults(page = 1) {
			axios
				.get(
					route('user.payments.list', {
						page,
						q: this.search
					})
				)
				.then((response) => {
					this.payments = response.data
				})
		}
	}
}
</script>
