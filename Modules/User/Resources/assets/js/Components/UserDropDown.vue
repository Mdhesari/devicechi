<template>
    <b-dropdown id="profile-box">
        <template #button-content>
            <b-avatar size="sm"></b-avatar>
        </template>

        <b-dropdown-item :href="route('user.dashboard')">
            <b-icon icon="gear"></b-icon>
            {{ __("global.user.profile.title") }}
        </b-dropdown-item>

        <b-dropdown-divider></b-dropdown-divider>

        <li class="dropdown-item">
            <inertia-link
                class="text-danger"
                method="post"
                :href="route('user.logout')"
            >
                <b-icon icon="power"></b-icon>
                {{ __("global.user.profile.logout") }}
            </inertia-link>
        </li>
    </b-dropdown>
</template>

<script>
export default {
    props: ["user"]
};
</script>
