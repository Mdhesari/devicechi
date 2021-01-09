<template>
    <ul class="tabs">
        <li class="tab-profile">
            <div class="avatar">
                <img :src="user.profile_photo_path" :alt="user.name" />
            </div>
            <div class="username">
                {{ user.name }}
            </div>
        </li>

        <!-- tabs -->
        <li
            v-for="(tab, index) in tabs"
            :key="index"
            class="tab-item"
            :class="{
                active: tab.is_active
            }"
        >
            <div class="tab-item-content">
                <inertia-Link
                    :href="tab.route"
                    v-text="tab.text"
                ></inertia-Link>
            </div>
        </li>
    </ul>
</template>

<script>
export default {
    props: ["user", "tabs"]
};
</script>
