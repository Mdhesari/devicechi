<template>
    <authLayout>
        <section class="demo">
            <b-container>
                <div class="mt-4">
                    <b-alert show variant="info">
                        <h4 class="alert-heading">
                            {{ __("ads.demo.warning.title") }}
                        </h4>
                        <p>
                            {{ __("ads.demo.warning.desc") }}
                        </p>
                    </b-alert>
                </div>
                <SingleAd :ad="ad"></SingleAd>
                <AdActionsGroup :ad="ad" />
            </b-container>
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
