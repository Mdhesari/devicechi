<template>
    <b-col class="preview-item" sm="6" md="4" lg="2">
        <img class="fluid" :src="picture.url" alt="Uploaded Picture" />
        <b-progress
            v-if="progress_active"
            :value="progress_value"
            :max="100"
            variant="danger"
            animated
        ></b-progress>
        <div class="actions">
            <b-button
                :disabled="progress_active"
                class="btn-delete"
                @click="removePicture(picture)"
            >
                <b-icon icon="x-circle-fill" aria-hidden="true"></b-icon>
            </b-button>
        </div>
    </b-col>
</template>

<script>
export default {
    props: ["picture"],
    data() {
        return {
            progress_value: 20,
            progress_active: false
        };
    },
    methods: {
        progressTimer() {
            let vm = this;

            let setIntervalRef = setInterval(function() {
                vm.progress_value += 20;
                if (vm.progress_value >= 100) {
                    clearInterval(setIntervalRef);
                }
            }, 50);
        },
        startProgressBar() {
            this.progress_value = 20;
            this.progress_active = true;

            this.progressTimer();
        },
        removePicture(picture) {
            this.startProgressBar();
            this.$emit("removePicture", picture);
        }
    }
};
</script>
