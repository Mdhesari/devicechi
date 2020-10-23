<template>
  <div class="text-center">
    <b-form @submit="onSubmit" @reset="onReset">
      <b-form-group class="phone_number" label="رایگان ثبت نام کنید!">
        <b-button type="submit" variant="secondary" class="btn-login-submit d-inline-block">
          <BIconArrowRight style="vertical-align: middle"></BIconArrowRight>
        </b-button>
        <b-form-input
          v-model="form.phone_number"
          class="w-25 mx-auto input-light-silver border-0 text-left dir-ltr d-inline-block"
        >
        </b-form-input>
      </b-form-group>
    </b-form>
  </div>
</template>

<script>
import { BIconArrowRight } from "bootstrap-vue";

export default {
  components: {
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