<template>
	<li>
		<MenuItemSearch v-if="isSearchBar(item)" :item="item"></MenuItemSearch>
		<MenuItemDropdown
			v-else-if="isSubmenu(item)"
			:item="item"
		></MenuItemDropdown>
		<MenuItemLink v-else-if="isLink(item)" :item="item"></MenuItemLink>
	</li>
</template>

<script>
import MenuItemHelper from './../../Mixins/MenuItemHelper'
import MenuItemSearch from './MenuItemSearch'
import MenuItemDropdown from './MenuItemDropdown'
import MenuItemLink from './MenuItemLink'

export default {
	name: 'MenuItem',
	props: ['item'],
	mixins: [MenuItemHelper],
	components: {
		MenuItemSearch,
		MenuItemDropdown,
		MenuItemLink
	}
}
</script>
