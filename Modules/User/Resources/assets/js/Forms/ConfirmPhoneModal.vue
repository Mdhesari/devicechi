<template>
	<b-modal v-model="isActive">
		<h4>کد پیامک شده به {{ phone }} را وارد کنید.</h4>

		<form
			@input="handleInput"
			@submit="onSubmit"
			@paste="onPaste"
			@keyup.delete="onBackspace"
			inline
			class="form-confirmation"
		>
			<div class="inputs">
				<input
					class="form-control"
					type="tel"
					autocomplete="off"
					required
					v-for="digit in digitsCount"
					:key="digit"
					maxlength="1"
					:name="'digit_' + digit"
				/>
			</div>
			<div class="errors">
				<p class="text-danger rtl">{{ form.errors.code }}</p>
			</div>
			<input
				:disabled="isLoading"
				type="submit"
				ref="btn_submit"
				value="تایید"
				id="btn-submit-confirmation"
			/>

			<div class="info mt-2 pt-4 rtl">
				<b-button
					:disabled="ratelimiter != null"
					variant="link"
					@click="resend_code"
				>
					<span v-if="resend" v-text="resend"></span>
					<span v-if="resend == null">
						{{ __('auth.resend.confirmation_code') }}
					</span>
					<span v-if="ratelimiter != null" class="text-info">
						{{
							__('global.ratelimiter.login', {
								ratelimiter: ratelimiter
							})
						}}
					</span>
				</b-button>
			</div>
		</form>

		<template #modal-footer class="text-center">
			<b-button @click="changeNumber" variant="link">
				شماره را اشتباه وارد کرده اید؟!
				<BIconArrowLeft style="vertical-align: middle"></BIconArrowLeft>
			</b-button>
		</template>
	</b-modal>
</template>

<script>
export default {
	props: {
		digitsCount: {
			default: 5
		}
	},

	data() {
		return {
			isLoading: false,
			isActive: false,
			ratelimiter: null,
			phone: '',
			resend: null,
			form: this.$inertia.form({
				code: 0
			})
		}
	},

	updated() {
		this.isLoading = false
	},

	methods: {
		activateAuth(phone, ratelimiter) {
			console.log(phone)
			this.phone = phone
			this.ratelimiter = ratelimiter

			this.startRatelimiter()

			if (this.resend) {
				setTimeout(() => {
					this.resend = null
				}, 5000)
			}

			this.isActive = true
		},
		deActivateAuth() {
			this.isActive = false
		},
		onSubmit(ev) {
			ev.preventDefault()

			const inputs = this.getInputs()

			let confirmation_code = ''

			inputs.forEach((input) => {
				confirmation_code += input.value
			})

			confirmation_code = Number(this.fixGivenNumber(confirmation_code))

			this.form.code = confirmation_code

			this.isLoading = true
			this.form.post(route('user.verify'), {
				preserveScroll: true
			})
		},
		handleInput(ev) {
			const input = ev.target

			if (input.nextElementSibling && input.value) {
				input.nextElementSibling.focus()
			} else if (!input.nextElementSibling) {
				this.$refs.btn_submit.focus()
			}
		},
		onPaste(ev) {
			const paste = ev.clipboardData.getData('text').trim()
			const inputs = this.getInputs()
			const btnAction = document.getElementById('btn-submit-confirmation')

			let i = 0

			for (let input of inputs) {
				if (paste[i] != undefined && !isNaN(Number(paste[i]))) {
					input.value = paste[i]
					input.focus()

					if (!input.nextElementSibling) {
						btnAction.focus()
					}
				} else {
					input.focus()
					break
				}
				i++
			}
		},
		onBackspace(ev) {
			if (ev.target.previousElementSibling)
				ev.target.previousElementSibling.focus()
		},
		getInputs() {
			return Array.from(document.querySelectorAll('.inputs input'))
		},
		changeNumber() {
			this.$emit('reset-form')
		},
		resend_code() {
			this.resend = this.__('auth.resend.confirmation_code')
			this.$emit('resend-login')
		},
		startRatelimiter() {
			if (this.ratelimiter != null) clearInterval(window.ratelimiterInterval)
			window.ratelimiterInterval = setInterval(() => {
				this.ratelimiter -= 1

				if (this.ratelimiter <= 0) {
					this.ratelimiter = null
					clearInterval(window.ratelimiterInterval)
				}
			}, 1000)
		}
	}
}
</script>
