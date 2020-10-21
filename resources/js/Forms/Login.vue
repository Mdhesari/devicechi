<template>
  <section class="login-form">
    <b-container>
      <div class="text-center">
        <b-form @submit="onSubmit" @reset="onReset">
          <b-form-group id="phone-number">
            <b-form-input
              placeholder="لطفا شماره موبایل خود را وارد نمایید."
              v-model="form.email"
            >
            </b-form-input>
          </b-form-group>

          <b-button type="submit" variant="primary">شروع کنید </b-button>
        </b-form>
      </div>
    </b-container>
  </section>
</template>

<script>
export default {
  data() {
    return {
      form: {
        phone_number: "",
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