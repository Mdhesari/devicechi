require('./bootstrap')

import Vue from 'vue'
import Lang from 'lang.js'
import VueToastr from 'vue-toastr'
import VueSwal from 'vue-swal'

import { InertiaApp } from '@inertiajs/inertia-vue'
import PortalVue from 'portal-vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import { InertiaProgress } from '@inertiajs/progress'

import moment from 'moment-jalaali'
import fa from 'moment/locale/fa'
import VueClipboard from 'vue-clipboard2'

moment.locale('fa', fa)
moment.loadPersian()

const default_locale = window.default_locale
const fallback_locale = window.fallback_locale
const messages = window.messages
Vue.prototype.$t = new Lang({
	messages: messages,
	locale: default_locale,
	fallback: fallback_locale
})

InertiaProgress.init({
	color: '#fcc55a',
	showSpinner: true
})

Vue.use(InertiaApp)
Vue.use(PortalVue)
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueToastr)
Vue.use(VueClipboard)
Vue.use(VueSwal)

Vue.mixin({
	methods: {
		route,
		$to(
			title,
			message = '',
			type = 'e' /* s: success, e: error, w:warning, i: information */
		) {
			if (!title) return this.$toastr

			return this.$toastr[type](message, title)
		},
		url(path = '') {
			if (path.charAt(0) == '/') path = path.substr(1)

			return this.$inertia.page.props.current_root + '/' + path
		},
		getProp(param, defaultVal = '') {
			return this.$inertia.page.props[param] || defaultVal
		},
		__(name, replace) {
			return this.$t.get(name, replace)
		},
		formatCurrency(currency) {
			// temp
			return 'ریال'
		},
		formatMoney(amount, decimalCount = 0, decimal = '.', thousands = ',') {
			try {
				decimalCount = Math.abs(decimalCount)
				decimalCount = isNaN(decimalCount) ? 0 : decimalCount

				const negativeSign = amount < 0 ? '-' : ''

				let i = parseInt(
					(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount))
				).toString()
				let j = i.length > 3 ? i.length % 3 : 0

				return (
					negativeSign +
					(j ? i.substr(0, j) + thousands : '') +
					i.substr(j).replace(/(\d{3})(?=\d)/g, '$1' + thousands) +
					(decimalCount
						? decimal +
						  Math.abs(amount - i)
								.toFixed(decimalCount)
								.slice(2)
						: '')
				)
			} catch (e) {
				this.$to(
					__('global.errors.common.title'),
					__('global.errors.common.desc')
				)
				console.log(e)
			}
		},
		moment(data = null) {
			// Todo :
			// dynamic locale set
			if (data === null) return moment()

			return moment(data)
		},
		fixGivenNumber(number) {
			if (!number) return false

			let persianNumbers = [
					/۰/g,
					/۱/g,
					/۲/g,
					/۳/g,
					/۴/g,
					/۵/g,
					/۶/g,
					/۷/g,
					/۸/g,
					/۹/g
				],
				arabicNumbers = [
					/٠/g,
					/١/g,
					/٢/g,
					/٣/g,
					/٤/g,
					/٥/g,
					/٦/g,
					/٧/g,
					/٨/g,
					/٩/g
				]

			if (typeof number === 'string') {
				for (var i = 0; i < 10; i++) {
					number = number
						.replace(persianNumbers[i], i)
						.replace(arabicNumbers[i], i)
				}
			}

			return number
		},
		fixGivenString(str) {
			const persianNumbers = [
					/۰/g,
					/۱/g,
					/۲/g,
					/۳/g,
					/۴/g,
					/۵/g,
					/۶/g,
					/۷/g,
					/۸/g,
					/۹/g
				],
				arabicNumbers = [
					/٠/g,
					/١/g,
					/٢/g,
					/٣/g,
					/٤/g,
					/٥/g,
					/٦/g,
					/٧/g,
					/٨/g,
					/٩/g
				]
			if (typeof str === 'string') {
				for (let i = 0; i < 10; i++) {
					str = str.replace(persianNumbers[i], i).replace(arabicNumbers[i], i)
				}
			}
			return str
		}
	}
})

const app = document.getElementById('app')

new Vue({
	render: (h) =>
		h(InertiaApp, {
			props: {
				initialPage: JSON.parse(app.dataset.page),
				resolveComponent: (name) => require(`./Pages/${name}`).default
			}
		}),
	//app.js
	mounted() {
		window.addEventListener('popstate', () => {
			this.$inertia.reload({
				preserveScroll: true,
				preserveState: false
			})
		})
	}
}).$mount(app)
