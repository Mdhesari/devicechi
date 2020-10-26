<template>
  <b-modal hide-footer v-model="isActive">
    <h4>کد پیامک شده را وارد کنید.</h4>

    <form
      @input="handleInput"
      @submit="onSubmit"
      @paste="onPaste"
      inline
      class="form-confirmation"
    >
      <div class="inputs">
        <input
          type="text"
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
export default {
  props: {
    digitsCount: {
      default: 5,
      confirmation_code: "",
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

      alert(this.confirmation_code);
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
        console.log(input, paste[i]);
        if (paste[i] != undefined && paste[i].trim().length != 0) {
          input.value = paste[i];
        } else {
          input.focus();
          break;
        }
        i++;
      }
    },
    getInputs() {
      return Array.from(document.querySelectorAll(".inputs input"));
    },
  },
};
</script>