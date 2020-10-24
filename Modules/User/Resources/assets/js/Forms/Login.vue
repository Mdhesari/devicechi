<template>
  <b-row>
    <b-col md="6">
      <div class="vector">
        <img
          class="sale-vector"
          src="../../img/vectors/sale.jpg"
          alt="Sale Online | فروش آنلاین"
        />
      </div>
    </b-col>

    <b-col md="6" class="text-right">
      <b-form @submit="onSubmit" @reset="onReset" class="login-form">
        <b-form-group class="phone_number" label="رایگان ثبت نام کنید!">
          <b-button
            type="submit"
            variant="secondary"
            class="btn-login-submit d-inline-block"
          >
            <BIconArrowRight style="vertical-align: middle"></BIconArrowRight>
          </b-button>
          <b-form-input
            v-model="form.phone_number"
            class="input-phone-number mx-auto input-light-silver border-0 text-left dir-ltr d-inline-block"
          >
          </b-form-input>
          <b-form-input
            disabled
            v-model="form.phone_code"
            class="input-phone-code input-light-silver border-0 text-center dir-ltr d-inline-block"
          ></b-form-input>
        </b-form-group>
      </b-form>
    </b-col>
  </b-row>
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
        phone_number: "",
        phone_code: "+98",
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