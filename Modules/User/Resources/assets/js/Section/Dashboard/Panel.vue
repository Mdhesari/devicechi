<template>
  <section class="user-panel-section">
    <div class="container">
      <div class="row user-panel-main">
        <div class="col-md-4">
          <div class="sidebar">
          <inertia-link :href="routes.ad.create" class="btn btn-success btn-rounded-high btn-mobilesale">{{
              $t.get("ads.create.btn_title")
            }}</inertia-link>
            <ul class="tabs">
              <li class="tab-profile">
                <div class="avatar">
                  <img src="img/person" alt="" />
                </div>
                <div class="username">
                  {{ user.name }}
                </div>
              </li>
              <li class="tab-item active">
                <div class="tab-item-content">
                  <a href="#">آگهی های ثبت شده</a>
                </div>
              </li>
              <li class="tab-item">
                <div class="tab-item-content">
                  <a href="">آگهی های در صف انتظار </a>
                </div>
              </li>
              <li class="tab-item">
                <div class="tab-item-content">
                  <a href="">آگهی های رد شده</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-8">
          <div class="content">
            <div class="row">
              <div class="col-md-6 blog adver">
                <div class="inner">
                  <div
                    class="thumbnail"
                    style="
                      background-image: url('https://images.unsplash.com/photo-1574675904801-eb2cca16af12?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1451&q=80');
                    "
                  ></div>
                  <div class="details">
                    <div class="title">
                      <h2>آیفون 11</h2>
                    </div>
                    <div class="status accept-back">منتشر شده</div>
                  </div>
                </div>
              </div>
              <div class="col-md-6"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: ["user", "routes"],

};
</script>