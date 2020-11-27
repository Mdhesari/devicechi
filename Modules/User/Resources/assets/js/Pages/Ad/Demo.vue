<template>
    <authLayout>
        <section class="demo">
            <SingleAd :ad="ad"></SingleAd>
            <AdActionsGroup />
        </section>
    </authLayout>
</template>

<script>
import AuthLayout from "../../Layouts/FrontAuthLayout";
import SingleAd from "../../Components/SingleAd";
import AdActionsGroup from "../../Components/AdActionsGroup";

export default {
    components: {
        AuthLayout,
        SingleAd,
        AdActionsGroup
    },
    props: ["ad"]
};
</script>
