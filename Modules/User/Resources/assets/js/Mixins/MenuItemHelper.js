import { isArray, isString } from 'lodash'

export default {
	methods: {
		isset(str) {
			return !(typeof str == 'undefined' || str == null)
		},
		getBadgeClass(item) {
			if (this.isset(item.badge_color)) {
				return `badget-${item.badge_color}`
			}

			return 'badge-primary'
		},
		isHeader(item) {
			return isString(item) || this.isset(item.header)
		},
		isLink(item) {
			return item.text && (this.isset(item.url) || this.isset(item.route))
		},
		isSearchBar(item) {
			return this.isset(item.text) && this.isset(item.search) && item.search
		},
		isSubmenu(item) {
			return (
				this.isset(item.text) &&
				this.isset(item.submenu) &&
				isArray(item.submenu)
			)
		},
		isAllowed(item) {
			const isAllowed = !(this.isset(item.restricted) && item.restricted)

			return item && isAllowed
		},
		isValidSidebarItem(item) {
			return (
				this.isHeader(item) &&
				this.isSearchBar(item) &&
				this.isSubmenu(item) &&
				this.isLink(item)
			)
		},
		isValidNavbarItem(item) {
			return this.isValidSidebarItem(item) && !this.isHeader(item)
		},
		isNavbarLeftItem(item) {
			return (
				this.isValidNavbarItem(item) && this.isset(item.topnav) && this.topnav
			)
		},
		isNavbarRightItem(item) {
			return (
				this.isValidNavbarItem(item) &&
				this.isset(item.topnav_right) &&
				this.topnav_right
			)
		},
		isNavbarUserItem(item) {
			return (
				this.isValidNavbarItem(item) &&
				this.isset(item.topnav_user) &&
				this.topnav_user
			)
		},
		isSidebarItem(item) {
			return (
				this.isValidSidebarItem(item) &&
				!this.isNavbarLeftItem(item) &&
				!this.isNavbarRightItem(item) &&
				!this.isNavbarUserItem(item)
			)
		}
	}
}
