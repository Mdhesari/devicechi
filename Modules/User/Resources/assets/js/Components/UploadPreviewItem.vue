<template>
    <b-col class="preview-item" sm="6" md="4" lg="2">
        <div
            v-show="isActive"
            class="badge badge-secondary active-badge"
            v-text="__('global.active-picture')"
        ></div>
        <img
            class="fluid"
            :src="picture.thumb_url"
            alt="Uploaded Picture"
            @click="$emit('changeActivePicture')"
        />
        <b-progress
            v-if="progress_id === picture.id"
            :value="progress_value"
            :max="100"
            variant="danger"
            animated
        ></b-progress>
        <div class="actions">
            <b-button
                :disabled="progress_id === picture.id"
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
    props: ["picture", "isActive"],
    data() {
        return {
            progress_value: 20,
            progress_id: null
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
            this.progress_id = true;

            this.progressTimer();
        },
        removePicture(picture) {
            this.progress_id = picture.id;
            this.startProgressBar();
            this.$emit("removePicture");
        }
    }
};
</script>
