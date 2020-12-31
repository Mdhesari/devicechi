<template>
    <authLayout :user="user">
        <section class="demo">
            <b-container>
                <div class="mt-4">
                    <div class="alert" :class="__(`ads.demo.${ad.status}.bg`)">
                        <h4 class="alert-heading">
                            {{ __(`ads.demo.${ad.status}.title`) }}
                        </h4>
                        <p>
                            {{ __(`ads.demo.${ad.status}.desc`) }}
                        </p>
                    </div>
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
    props: ["ad", "user"]
};
</script>
