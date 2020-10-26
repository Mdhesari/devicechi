<template>
  <b-modal hide-footer v-model="isActive">
    <h4>کد پیامک شده را وارد کنید.</h4>

    <form @submit="onSubmit" inline class="form-confirmation">
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
  },
};
</script>