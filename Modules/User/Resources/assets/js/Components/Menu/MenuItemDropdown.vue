<template>
	<div>
		<a class="nav-link dropdown-toggle" href="#">
			<i v-if="item.icon" :class="item.icon"></i>

			{{ item.text }}

			<span v-if="isset(item.label)" class="badge" :class="getBadgeClass(item)">
				{{ item.label }}
			</span>
		</a>

		<ul class="dropdown-menu border-0 shadow">
			<MenuItem
				v-for="(child, index) in item.submenu"
				:key="index"
				:item="child"
			></MenuItem>
		</ul>
	</div>
</template>

<script>
import MenuItemHelper from './../../Mixins/MenuItemHelper'

export default {
	name: 'MenuItemDropdown',
	components: {
		// recursive component
		MenuItem: () => import('./MenuItem')
	},
	props: ['item'],
	mixins: [MenuItemHelper]
}
</script>
