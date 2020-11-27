<template>
    <authLayout>
        <section class="demo">
            <b-container>
                <h1>Demo Ad</h1>
            </b-container>
        </section>
    </authLayout>
</template>

<script>
import AuthLayout from "../../Layouts/FrontAuthLayout";

export default {
    components: {
        AuthLayout
    },
    props: ["ad"]
};
</script>
