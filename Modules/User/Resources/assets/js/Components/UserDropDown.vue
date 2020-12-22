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
            <form :action="route('user.session.logout')" method="post">
                <input type="hidden" name="_token" :value="csrf" />
                <b-button type="submit" variant="link" class="text-danger d-block">
                    <b-icon icon="power"></b-icon>
                    {{ __("global.user.profile.logout") }}
                </b-button>
            </form>
        </li>
    </b-dropdown>
</template>

<script>
export default {
    props: ["user"],
    computed: {
        csrf() {
            return document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");
        }
    }
};
</script>
