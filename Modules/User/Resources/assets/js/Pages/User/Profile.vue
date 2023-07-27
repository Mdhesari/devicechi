<template>
    <AuthLayout :user="user">
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
    props: ["user", "tabs"],
    components: {
        AuthLayout,
        Panel,
        ProfileForm
    }
};
</script>
