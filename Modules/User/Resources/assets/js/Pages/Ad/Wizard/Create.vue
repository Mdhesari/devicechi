<template>
    <AuthLayout>
        <div class="create-ad">
            <b-container>
                <h1>
                {{ $t.get('ads.create.title')) }}
                </h1>
                <p>hi</p>
            </b-container>
        </div>
    </AuthLayout>
</template>

<script>
import AuthLayout from "../../Layouts/FrontAuthLayout";

export default {
    components: {
        AuthLayout
    },
    data() {
        return {
            current: "step_1"
        };
    }
};
</script>
