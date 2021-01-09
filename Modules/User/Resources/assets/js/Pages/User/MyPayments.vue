<template>
    <AuthLayout :user="user">
        <Panel :user="user" :tabs="tabs">
            <div class="row" v-if="payments.length > 0">
                <!-- <div class="col-md-6"></div> -->
                <b-table striped hover :items="payments"></b-table>
            </div>

            <!-- No Content -->
            <b-alert
                :show="payments.length < 1"
                variant="info"
                class="text-center mt-4"
            >
                شما هیچ پرداختی ندارید!
            </b-alert>
        </Panel>
    </AuthLayout>
</template>

<script>
import AuthLayout from "../../Layouts/FrontAuthLayout";
import Panel from "../../Section/Dashboard/Panel";

export default {
    components: {
        Panel,
        AuthLayout
    },
    props: ["user", "tabs", "payments"]
};
</script>
