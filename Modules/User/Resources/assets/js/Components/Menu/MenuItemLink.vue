<template>
	<inertia-link :class="item.class" :href="item.href" :target="urlTarget">
		<i v-if="isset(item.icon)" :class="item.icon"></i>

		{{ item.text }}

		<span v-if="isset(item.label)" class="badge" :class="getBadgeClass(item)">
			{{ item.label }}
		</span>
	</inertia-link>
</template>

<script>
import MenuItemHelper from './../../Mixins/MenuItemHelper'

export default {
	props: ['item'],
	mixins: [MenuItemHelper],
	computed: {
		urlTarget() {
			return this.isset(this.item.target) ? this.item.target : '_self'
		}
	}
}
</script>
