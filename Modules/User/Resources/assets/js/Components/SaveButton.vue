<template>
	<div>
		<button id="bookmark-btn" class="btn rounded" @click="save">
			<b-icon :icon="isSaved ? 'bookmark-check-fill' : 'bookmark'"></b-icon>
		</button>
		<b-tooltip v-if="user" target="bookmark-btn" triggers="click blur">
			<span v-if="isSaved" v-text="__('global.bookmark')"></span>

			<span v-if="!isSaved" v-text="__('global.unbookmark')"></span>
		</b-tooltip>

		<b-tooltip v-if="!user" target="bookmark-btn" triggers="hover">
			<span v-text="__('global.need_login')"></span>
		</b-tooltip>
	</div>
</template>

<script>
export default {
	props: ['ad', 'user'],
	data() {
		return {
			isSaved: Boolean(this.getProp('is_bookmarked_for_user'))
		}
	},
	methods: {
		async save() {
			if (!this.user) {
				window.location.href = route('user.login')
			}

			const response = await axios.post(route('user.ad.bookmark'), {
				ad: this.ad.id,
				attach: !this.isSaved
			})

			if (response.status == 200) {
				this.isSaved = !this.isSaved
			}
		}
	}
}
</script>
