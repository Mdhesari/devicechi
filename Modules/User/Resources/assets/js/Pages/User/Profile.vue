<template>
    <AuthLayout :user="user">
        <b-alert
            :show="success_session"
            variant="success"
            v-text="success_session"
        ></b-alert>
        <Panel :user="user" :tabs="tabs">
            <ProfileForm :user="user"></ProfileForm>
        </Panel>
    </AuthLayout>
</template>

<script>
import AuthLayout from "../../Layouts/FrontAuthLayout";
import Panel from "../../Section/Dashboard/Panel";
import ProfileForm from "../../Forms/ProfileForm";

export default {
    props: ["user", "tabs", "success_session"],
    components: {
        AuthLayout,
        Panel,
        ProfileForm
    }
};
</script>
