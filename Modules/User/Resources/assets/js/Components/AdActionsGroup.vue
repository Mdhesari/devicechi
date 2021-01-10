<template>
    <div class="actions-navbar">
        <b-button-group>
            <b-button  v-b-tooltip.hover :title="__('ads.actions.save')" class="btn-save" @click="publishAd">
                <!-- <span class="label">
                    {{ __("ads.actions.save") }}
                </span> -->
                <b-icon class="vertical-middle" icon="check-circle"></b-icon>
            </b-button>
            <b-button  v-b-tooltip.hover :title="__('ads.actions.delete')" class="btn-delete" @click="deleteAd">
                <!-- <span class="label">
                    {{ __("ads.actions.delete") }}
                </span> -->
                <b-icon class="vertical-middle" icon="trash-fill"></b-icon>
            </b-button>
            <b-button  v-b-tooltip.hover :title="__('ads.actions.archive')" class="btn-archive" @click="archiveAd">
                <!-- <span class="label">
                    {{ __("ads.actions.archive") }}
                </span> -->
                <b-icon class="vertical-middle" icon="pencil-square"></b-icon>
            </b-button>
            <b-button  v-b-tooltip.hover :title="__('ads.actions.back')" class="btn-back" @click="getBack">
                <!-- <span class="label">
                    {{ __("ads.actions.back") }}
                </span> -->
                <b-icon class="vertical-middle" icon="arrow-left"></b-icon>
            </b-button>
        </b-button-group>
    </div>
</template>

<script>
export default {
    props: ["ad"],
    methods: {
        getBack() {
            this.$inertia.visit(
                route("user.ad.step_phone_details", {
                    ad: this.ad.slug
                })
            );
        },
        publishAd() {
            this.$inertia.post(route("user.ad.step_phone_demo.publish"), {
                _method: "PUT",
                ad: this.ad
            });
        },
        deleteAd() {
            this.$inertia.post(route("user.ad.step_phone_demo.delete"), {
                _method: "PUT",
                ad: this.ad
            });
        },
        archiveAd() {
            this.$inertia.post(route("user.ad.step_phone_demo.archive"), {
                _method: "PUT",
                ad: this.ad
            });
        }
    }
};
</script>
