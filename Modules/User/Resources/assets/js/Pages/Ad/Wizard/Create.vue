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
                        </div>
                    </div>
                </div>
                <div class="form-content">
                    <div class="card wizard-card">
                        <div class="card-body">
                            <form @submit.prevent>
                                <input type="submit" />
                            </form>
                        </div>
                    </div>
                </div>
            </b-container>
        </section>
    </AuthLayout>
</template>

<script>
import AuthLayout from "../../../Layouts/FrontAuthLayout";

export default {
    components: {
        AuthLayout
    },
    data() {
        return {
            tab: "steb_1",
            step: 1
        };
    }
};
</script>
