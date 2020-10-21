<template>
  <AppSection class="login-form">
    <b-container>
      <div class="text-center">
        <b-form @submit="onSubmit" @reset="onReset">
          <b-form-group class="phone_number" label="رایگان ثبت نام کنید!">
            <b-form-input
              v-model="form.phone_number"
              class="w-25 mx-auto input-light-silver border-0 text-left dir-ltr"
            >
            </b-form-input>
          </b-form-group>

          <b-button type="submit" variant="secondary" class="btn-login-submit">
            <BIconArrowRight style="vertical-align: middle"></BIconArrowRight>
            شروع کنید
          </b-button>
        </b-form>
      </div>
    </b-container>
  </AppSection>
</template>

<script>
import AppSection from "./../Components/AppSection";
import { BIconArrowRight } from "bootstrap-vue";

export default {
  components: {
    AppSection,
    BIconArrowRight,
  },

  data() {
    return {
      form: {
        phone_number: "+98 ",
      },
    };
  },

  methods: {
    onSubmit(e) {
      e.preventDefault();

      console.log(JSON.stringify(this.form));
    },
    onReset() {
      alert("rest");
    },
  },
};
</script>