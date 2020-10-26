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

      alert("confirming...");
    },
    handleInput(ev) {
      const input = ev.target;

      if (input.nextElementSibling && input.value) {
        input.nextElementSibling.focus();
      }
    },
    onPaste(ev) {
      const paste = ev.clipboardData.getData("text");
      const inputs = document.querySelectorAll(".inputs input");
      let i = 0;

      for (let input of inputs) {
        if (paste[i] != undefined && paste[i] != "") input.value = paste[i];
        else {
          input.focus();
          break;
        }
        i++;
      }
    },
  },
};
</script>