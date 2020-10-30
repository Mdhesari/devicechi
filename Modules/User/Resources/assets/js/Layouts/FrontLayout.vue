<template>
  <div>
    <Header></Header>

    <!-- Page Content -->
    <main class="main-site">
      <slot></slot>
    </main>

    <Footer></Footer>
  </div>
</template>

<script>
import Header from "../Section/Header";
import Footer from "../Section/Footer";

export default {
  components: {
    Header,
    Footer,
  },
};
</script>