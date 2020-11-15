<template>
    <AuthLayout>
        <section class="wizard">
            <b-container>
                <div class="step-indicator">
                    <div class="indicator-line">
                        <div class="text-center">
                            <div
                                class="steps"
                                :class="{
                                    active: step === 1,
                                    completed: step > 1
                                }"
                            >
                                <b-icon
                                    v-if="step > 1"
                                    icon="check"
                                    class="icon-check"
                                />
                            </div>
                            <div
                                class="steps"
                                :class="{
                                    active: step === 2,
                                    completed: step > 2
                                }"
                            >
                                <b-icon
                                    v-if="step > 2"
                                    icon="check"
                                    class="icon-check"
                                />
                            </div>
                            <div
                                class="steps"
                                :class="{
                                    active: step === 3,
                                    completed: step > 3
                                }"
                            >
                                <b-icon
                                    v-if="step > 3"
                                    icon="check"
                                    class="icon-check"
                                />
                            </div>
                            <div
                                class="steps"
                                :class="{
                                    active: step === 4,
                                    completed: step > 4
                                }"
                            >
                                <b-icon
                                    v-if="step > 4"
                                    icon="check"
                                    class="icon-check"
                                />
                            </div>
                            <div
                                class="steps"
                                :class="{
                                    active: step === 5,
                                    completed: step > 5
                                }"
                            >
                                <b-icon
                                    v-if="step > 5"
                                    icon="check"
                                    class="icon-check"
                                />
                            </div>
                            <div
                                class="steps"
                                :class="{
                                    active: step === 6,
                                    completed: step > 6
                                }"
                            >
                                <b-icon
                                    v-if="step > 6"
                                    icon="check"
                                    class="icon-check"
                                />
                            </div>
                            <div
                                class="steps"
                                :class="{
                                    active: step === 7,
                                    completed: step > 7
                                }"
                            >
                                <b-icon
                                    v-if="step > 7"
                                    icon="check"
                                    class="icon-check"
                                />
                            </div>
                            <div
                                class="steps"
                                :class="{
                                    active: step === 8,
                                    completed: step > 8
                                }"
                            >
                                <b-icon
                                    v-if="step > 8"
                                    icon="check"
                                    class="icon-check"
                                />
                            </div>
                            <div
                                class="steps"
                                :class="{
                                    active: step === 9,
                                    completed: step > 9
                                }"
                            >
                                <b-icon
                                    v-if="step > 9"
                                    icon="check"
                                    class="icon-check"
                                />
                            </div>
                            <div
                                class="steps"
                                :class="{
                                    active: step === 10,
                                    completed: step > 10
                                }"
                            >
                                <b-icon
                                    v-if="step > 10"
                                    icon="check"
                                    class="icon-check"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Wizard steps -->
                <div class="form-content">
                    <div class="card wizard-card">
                        <keep-alive>
                            <component :is="tab" @next="setTab"></component>
                        </keep-alive>
                    </div>
                </div>
                <!-- End wiazrd steps -->
            </b-container>
        </section>
    </AuthLayout>
</template>

<script>
import AuthLayout from "../../../Layouts/FrontAuthLayout";
import ChooseBrand from "./ChooseBrand";
import ChooseModel from "./ChooseModel";
import ChooseVariant from "./ChooseVariant";
import ChooseAccessory from "./ChooseAccessory";
import ChooseAge from "./ChooseAge";
import ChoosePrice from "./ChoosePrice";
import UploadPictures from "./UploadPictures";
import ChooseLocation from "./ChooseLocation";
import ChooseContact from "./ChooseContact";
import FinalInfo from "./FinalInfo";

export default {
    components: {
        AuthLayout: AuthLayout,
        step_1: ChooseBrand,
        step_2: ChooseModel,
        step_3: ChooseVariant,
        step_4: ChooseAccessory,
        step_5: ChooseAge,
        step_6: ChoosePrice,
        step_7: UploadPictures,
        step_8: ChooseLocation,
        step_9: ChooseContact,
        step_10: FinalInfo
    },
    props: ["step"],
    computed: {
        tab() {
            return "step_" + this.step;
        }
    },
    methods: {
        setTab() {
            this.step++;

            this.tab = "step_" + this.step;
        }
    }
};
</script>
