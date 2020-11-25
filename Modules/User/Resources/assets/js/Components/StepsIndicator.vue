<template>
    <div class="step-indicator">
        <div class="indicator-line">
            <div class="text-center">
                <div
                    v-for="(i_step, index) in steps"
                    :key="index"
                    class="steps"
                    :class="{
                        active: step === i_step,
                        completed: step > i_step
                    }"
                >
                    <b-icon
                        v-if="step > i_step"
                        icon="check"
                        class="icon-check"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["steps", "step"]
};
</script>
