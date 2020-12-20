<template>
    <AuthLayout :user="user">
        <b-alert
            :show="success_session"
            variant="success"
            v-text="success_session"
        ></b-alert>
        <Panel :user="user" :allStatus="all_status"></Panel>
    </AuthLayout>
</template>

<script>
import AuthLayout from "../../Layouts/FrontAuthLayout";
import Panel from "../../Section/Dashboard/Panel";
export default {
    props: ["user", "all_status", "success_session"],
    components: {
        AuthLayout,
        Panel
    }
};
</script>
