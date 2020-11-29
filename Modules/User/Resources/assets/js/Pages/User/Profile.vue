<template>
    <AuthLayout>
        <Panel :user="user" :allStatus="all_status"></Panel>
    </AuthLayout>
</template>

<script>
import AuthLayout from "../../Layouts/FrontAuthLayout";
import Panel from "../../Section/Dashboard/Panel";
export default {
    props: ["user", "all_status"],
    components: {
        AuthLayout,
        Panel
    }
};
</script>
