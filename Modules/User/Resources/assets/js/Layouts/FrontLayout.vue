<template>
  <div>
    <!-- Header Content -->
    <header class="header-site">
      <!-- Back Cover Menu -->
      <div class="dark-back" id="darkBack" onclick="closeMenu()"></div>
      <div class="container">
        <div class="right-side">
          <!-- <button class="burger-btn" id="burgerBtn" onclick="openMenu()">
                <span class="rec"></span>
                <span class="rec width18"></span>
            </button> -->
          <a href="#" class="btn action-btn add-advertisment">
            ورود یا ثبت نام
          </a>

          <!-- Primary Navigation Menu -->
          <nav class="main-menu" id="mainMenu">
            <!-- Navigation Links -->
            <ul>
              <li><a href="#">آیتم اول</a></li>
              <li><a href="#">آیتم دوم</a></li>
            </ul>
          </nav>
        </div>

        <div class="left-side">
          <!-- Logo -->
          <div class="logo">
            <img src="../../img/logo-white.png" alt="Mobile For Sales" />
          </div>
        </div>
      </div>
    </header>

    <!-- Page Content -->
    <main class="main-site">
      <slot></slot>
    </main>

    <!-- Footer Content -->
    <footer class="footer-site">
      <div class="container">
        <div class="row">
          <div class="col-md-2">
            <div class="social">
              <a href="#" target="_blank" class="linkedin">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
              <a href="#" target="_blank" class="instagram">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
            </div>
          </div>
          <div class="col-md-5">
            <div class="menu text-center">
              <ul>
                <li>
                  <inertia-link href="/about-us" replace>درباره ی ما </inertia-link>
                </li>
                <li>
                  <a href="#">تماس با ما </a>
                </li>
                <li>
                  <a href="#">قوانین </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-5">
            <div class="copy-right">
              کلیه حقوق مادی و معنوی این وبسایت محفوظ می باشد
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: "hi",
    };
  },
};
</script>