<template>
  <b-row>
    <confirm-modal
      ref="confirmModal"
      :verifyRoute="routes.user_auth_verify"
    ></confirm-modal>
    <b-col md="6">
      <div class="vector">
        <img
          class="sale-vector"
          src="../../img/vectors/sale-2.png"
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
            v-model="form.phone"
            type="tel"
            minlength="6"
            maxlength="10"
            class="input-phone-number mx-auto input-light-silver border-0 text-left dir-ltr d-inline-block"
          >
          </b-form-input>
          <b-form-input
            disabled
            v-model="form.phone_country_code"
            class="input-phone-code input-light-silver border-0 text-center dir-ltr d-inline-block"
          ></b-form-input>
          <p class="m-2 text-danger">{{ form.error("phone") }}</p>
        </b-form-group>
      </b-form>
    </b-col>
  </b-row>
</template>

<script>
import { BIconArrowRight } from "bootstrap-vue";
import ConfirmModal from "../Forms/ConfirmPhoneModal";
import Axios from "axios";

export default {
  components: {
    BIconArrowRight,
    ConfirmModal,
  },

  data() {
    return {
      routes: this.$inertia.page.props.routes,
      form: this.$inertia.form(
        {
          phone: "",
          phone_country_code: "+98",
        },
        {
          bag: "createUser",
          resetOnSuccess: false,
        }
      ),
    };
  },

  methods: {
    onSubmit(e) {
      e.preventDefault();

      let auth_route = this.routes.user_auth;

      let result = this.form
        .post(auth_route, {
          preserveScroll: true,
        })
        .then((response) => {
          if (this.$inertia.page.props.trigger_auth) {
            this.$refs.confirmModal.activateAuth();
          }
        })
        .catch(() => console.log("error"));
    },
    onReset() {
      alert("rest");
    },
  },
};
</script>