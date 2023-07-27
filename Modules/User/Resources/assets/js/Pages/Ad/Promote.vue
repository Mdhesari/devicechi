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

								<div class="row">
									<div class="col-12 col-md-8">
										<div class="row list-promotions mobile-radio-form">
											<b-form-checkbox
												class="col-12 my-4 text-right"
												v-for="(promotion, index) in promotions.data"
												:disabled="
													isLoading ||
														promotion.free ||
														Boolean(promotion.activate_at) ||
														promotion.paid
												"
												:key="index"
												:name="'promotion_' + promotion.id"
												v-model="selected[promotion.id]"
												:value="promotion.id"
												@change="updateFinalPrice"
											>
												<h5 class="promote-title">
													<!-- {{ __('promotions.' + accessory.title) }} -->
													{{ promotion.title }}
													<span v-if="promotion.free">(رایگان)</span>
													<span v-if="promotion.activate_at">(غیر فعال)</span>
													<span v-if="promotion.paid" class="text-success"
														>(پرداخت شده)</span
													>
												</h5>
												<p class="promote-desc">{{ promotion.description }}</p>
												<p class="promote-price">
													<span>{{ formatMoney(promotion.price) }}</span>
													<span>{{ formatCurrency(promotion.currency) }}</span>
												</p>
												<b-alert
													variant="warning"
													:show="promotion.activate_at"
												>
													{{ moment(promotion.activate_at).fromNow(true) }}
													تا فعال شدن پرداخت
												</b-alert>
											</b-form-checkbox>
										</div>
									</div>
									<div class="col-12 col-md-4">
										<div
											class="sidebar payment-box"
											ref="sidebar"
											:style="sidebarStyles"
										>
											<div class="text-center">
												<h5>قابل پرداخت :</h5>
												<h6 class="final-price">
													<span> {{ formatMoney(finalPrice) }} </span>
													<span>{{ formatCurrency(finalCurrency) }}</span>
												</h6>
											</div>
											<div class="btn-group mt-4 w-100 mx-auto">
												<button
													:disabled="finalPrice <= 0"
													class="btn btn-success"
													type="submit"
												>
													{{ __('ads.pay') }}
												</button>
												<inertia-link
													:href="
														route('user.ad.step_phone_demo', {
															ad
														})
													"
													class="btn btn-link text-secondary"
													>بازگشت</inertia-link
												>
											</div>
											<p class="text-help text-muted text-center mt-3">
												پرداخت امن از طریق کارت های شتاب امکان پذیر میباشد.
											</p>
										</div>
									</div>
								</div>
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
const offset = 180

export default {
	components: {
		AuthLayout
	},
	props: ['ad', 'user', 'promotions'],
	computed: {
		isMd() {
			return window.matchMedia('(max-width: 991px)').matches
		},
		sidebarStyles() {
			return {
				position: this.isStuck ? 'fixed' : null,
				top: this.isStuck && this.scrollDown ? offset + 'px' : null,
				// top:
				// 	this.isStuck && !this.scrollDown
				// 		? offset + 'px'
				// 		: this.offsetTop && !this.isStuck
				// 		? this.offsetTop + 'px'
				// 		: null,
				width: this._sidebarWidth + 'px'
			}
		}
	},
	data() {
		return {
			finalPrice: this.getProp('finalPrice', 0),
			finalCurrency: 'IRR',
			selected: this.getProp('selected', []),
			isLoading: false,
			scrollDown: false,
			scrollPosition: 0,
			offsetTop: 0,
			isStuck: false
		}
	},
	mounted() {
		if (!this.isMd) {
			// ensure first render is complete to get proper positions
			this.$nextTick(() => {
				const {
					width,
					height,
					top
				} = this.$refs.sidebar.getBoundingClientRect()
				this._sidebarHeight = height
				this._sidebarWidth = width
				this._sidebarTop = top
				this._sidebarBottom =
					this._sidebarTop + this._sidebarHeight + offset - window.innerHeight
				// this._footerTop = this.$refs.footer.getBoundingClientRect().top
				// this._footerHeight = this.$refs.footer.getBoundingClientRect().height

				document.addEventListener('scroll', this.handleScroll)
			})
		}
	},
	methods: {
		next() {
			axios
				.put(
					route('user.ad.step_phone_payment.gateway', {
						ad: this.ad
					}),
					{
						promotions: this.selected
					}
				)
				.then((response) => {
					window.location = response.data.action
				})
		},
		updateFinalPrice(selected) {
			axios
				.post(
					route('user.ad.step_phone_promote.finalPrice', {
						ad: this.ad
					}),
					{
						promotions: this.selected
					}
				)
				.then((response) => {
					this.finalPrice = response.data.price
					this.finalCurrency = response.data.currency
				})
		},
		handleScroll() {
			let newScrollPosition = window.pageYOffset
			this.directionChange = false

			// scrolling downwards
			if (newScrollPosition > this.scrollPosition) {
				this.checkPosition(newScrollPosition, 'down')

				// scrolling upwards
			} else {
				this.checkPosition(newScrollPosition, 'up')
			}

			// save the current scroll position to compare to the next scroll position
			this.scrollPosition = newScrollPosition
		},
		checkPosition(pos, dir = 'down') {
			// check if the direction has recently changed
			if (dir === 'up' && this.scrollDown) {
				this.directionChange = true
				this.scrollDown = false
			}
			if (dir === 'down' && !this.scrollDown) {
				this.directionChange = true
				this.scrollDown = true
			}

			// check if the sidebar should be position fixed / isStuck
			if (
				(dir === 'up' && pos < this.offsetTop - offset + this._sidebarTop) ||
				(dir == 'down' && pos > this._sidebarBottom + this.offsetTop)
			) {
				this.isStuck = true
			} else {
				// if the direction has recently changed, set the top style to the current top position of the sidebar
				if (this.directionChange) {
					this.offsetTop =
						pos +
						this.$refs.sidebar.getBoundingClientRect().top -
						this._sidebarTop
				}
				this.isStuck = false
			}

			// if the sidebar / scroll has reached it's usual place at the top of the page
			if (dir === 'up' && pos <= this._sidebarTop - offset) {
				this.isStuck = false
				this.offsetTop = null
			}

			// if we've reached the footer area
			// then unstick the sidebar and set the top style
			if (
				dir === 'down' &&
				pos > this._footerTop - window.innerHeight - offset
			) {
				this.isStuck = false
				// this.offsetTop =
				// 	this._footerTop -
				// 	this._footerHeight -
				// 	this._sidebarHeight -
				// 	this._sidebarTop -
				// 	offset * 2
				// dynamic positioning – sometimes sets too low top if scrolling fast
				// this.offsetTop = pos + this.$refs.sidebar.getBoundingClientRect().top - this._sidebarTop;
			}
		}
	}
}
</script>
