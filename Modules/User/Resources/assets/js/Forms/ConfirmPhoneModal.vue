<template>
  <b-modal hide-footer v-model="isActive">
    <h4>کد پیامک شده را وارد کنید.</h4>

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
      <input type="submit" value="تایید" />
    </form>
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
    };
  },

  methods: {
    activateAuth() {
      this.isActive = true;
    },
    onSubmit(ev) {
      ev.preventDefault();

      const inputs = this.getInputs();

      this.confirmation_code = "";

      inputs.forEach((input) => {
        this.confirmation_code += input.value;
      });

      this.confirmation_code = Number(this.confirmation_code);

      let form = this.$inertia.form({
        code: this.confirmation_code,
      });

      axios
        .post(this.verifyRoute, {
          code: this.confirmation_code,
        })
        .then((r) => console.log("ok"));
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
      let i = 0;

      for (let input of inputs) {
        if (paste[i] != undefined && !isNaN(Number(paste[i]))) {
          input.value = paste[i];
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
  },
};
</script>