<template>
    <WizardStep>
        <form @submit.prevent="next">
            <p class="form-title">
                {{ $t.get("ads.wizard.choose_brand.title") }}
            </p>
            <p class="form-desc">
                {{ $t.get("ads.wizard.choose_brand.desc") }}
            </p>

            <div class="row brand-list">
                <div class="col-md-2 brand-item">
                    <a href="#">
                        <img
                            src="https://cdn.recycledevice.com/brands/apple.png"
                            alt="Apple"
                        />
                        <h4 class="brand-label">Apple</h4>
                    </a>
                </div>

                <div class="col-md-2 brand-item">
                    <a href="#">
                        <img
                            src="https://cdn.recycledevice.com/brands/asus.png"
                            alt="Asus"
                        />
                        <h4 class="brand-label">Apple</h4>
                    </a>
                </div>

                <div class="col-md-2 brand-item">
                    <a href="#">
                        <img
                            src="https://cdn.recycledevice.com/brands/huawei.png"
                            alt="Apple"
                        />
                        <h4 class="brand-label">Apple</h4>
                    </a>
                </div>
            </div>

            <b-button v-if="isContinue" variant="secondary" type="submit">
                {{ $t.get("ads.wizard.btn.continue") }}
            </b-button>
        </form>
    </WizardStep>
</template>

<script>
import WizardStep from "../../../Components/WizardStep";

export default {
    components: {
        WizardStep
    },
    data() {
        return {
            title: "",
            isContinue: true
        };
    },
    methods: {
        next() {
            this.$emit("next");
        }
    }
};
</script>