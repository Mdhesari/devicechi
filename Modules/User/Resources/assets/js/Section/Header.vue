<template>
  <!-- Header Content -->
  <header class="header-site">
    <!-- Back Cover Menu -->
    <div
      @click="showNavbar = false"
      :class="{ active: showNavbar }"
      class="dark-back"
      id="darkBack"
    ></div>
    <div class="container">
      <div class="right-side">
        <button @click="showNavbar = true" class="burger-btn" id="burgerBtn">
          <span class="rec"></span>
          <span class="rec width18"></span>
        </button>

        <a href="#" class="btn action-btn add-advertisment">
          ورود یا ثبت نام
        </a>

        <Navbar :class="{ navActive: showNavbar }"></Navbar>
      </div>

      <div class="left-side">
        <!-- Logo -->
        <div class="logo">
          <img src="../../img/mobile-logo.png" alt="Mobile For Sales" />
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import Navbar from "./Navigation";

export default {
  data() {
    return {
      showNavbar: false,
    };
  },
  components: {
    Navbar,
  },
};
</script>