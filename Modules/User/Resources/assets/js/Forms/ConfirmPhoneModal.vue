<template>
  <b-modal v-model="isActive">
    <h4>کد پیامک شده به {{ phone }} را وارد کنید.</h4>

    <form
      @input="handleInput"
      @submit="onSubmit"
      @paste="onPaste"
      @keyup.delete="onBackspace"
      inline
      class="form-confirmation"
    >
      <div class="inputs">
        <input
          type="text"
          required
          v-for="digit in digitsCount"
          :key="digit"
          maxlength="1"
          :name="'digit_' + digit"
        />
      </div>
      <div class="errors">
        <p class="text-danger">{{ form.error("code") }}</p>
      </div>
      <input type="submit" value="تایید" id="btn-submit-confirmation" />
    </form>

    <template #modal-footer class="text-center">
      <b-button @click="changeNumber" variant="link">
        شماره را اشتباه وارد کرده اید؟!
        <BIconArrowLeft style="vertical-align: middle"></BIconArrowLeft>
      </b-button>
    </template>
  </b-modal>
</template>

<script>
import Axios from "axios";
export default {
  props: {
    digitsCount: {
      default: 5,
      confirmation_code: "",
    },
    verifyRoute: {
      required: true,
    },
  },

  data() {
    return {
      isActive: false,
      phone: "",
      form: this.$inertia.form({
        code: 0,
      }),
    };
  },

  methods: {
    activateAuth(phone) {
      this.phone = phone;

      this.isActive = true;
    },
    deActivateAuth() {
      this.isActive = false;
    },
    onSubmit(ev) {
      ev.preventDefault();

      const inputs = this.getInputs();

      let confirmation_code = "";

      inputs.forEach((input) => {
        confirmation_code += input.value;
      });

      confirmation_code = Number(confirmation_code);

      this.form.code = confirmation_code;

      this.form.post(this.verifyRoute);
    },
    handleInput(ev) {
      const input = ev.target;

      if (input.nextElementSibling && input.value) {
        input.nextElementSibling.focus();
      }
    },
    onPaste(ev) {
      const paste = ev.clipboardData.getData("text").trim();
      const inputs = this.getInputs();
      const btnAction = document.getElementById("btn-submit-confirmation");

      let i = 0;

      for (let input of inputs) {
        if (paste[i] != undefined && !isNaN(Number(paste[i]))) {
          input.value = paste[i];
          input.focus();

          if (!input.nextElementSibling) {
            btnAction.focus();
          }
        } else {
          input.focus();
          break;
        }
        i++;
      }
    },
    onBackspace(ev) {
      if (ev.target.previousElementSibling)
        ev.target.previousElementSibling.focus();
    },
    getInputs() {
      return Array.from(document.querySelectorAll(".inputs input"));
    },
    changeNumber() {
      this.$emit("reset-form");
    },
  },
};
</script>