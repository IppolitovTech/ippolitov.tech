<template>
  <div>
    This portfolio has been created since 2013 to 2017 years. The rest of the
    time until today I worked with internal projects of different companies.
    Most of the projects were in Russian language.
    <p>My last work is:</p>

    <p>
      1) Technical support this site:
      <a href="https://kazatu.edu.kz/"
        >S.Seifullin Kazakh Agro Technical University</a
      >
    </p>

    <p>
      2) Technical support this site:
      <a href="http://bulletinofscience.kazatu.edu.kz/"
        >Magazine «Bulletin of Science of the S.Seifullin Kazakh Agrotechnical
        University»</a
      >
      Used: Open Journal systems framework.
    </p>
    <p>It's work websites:</p>
    <div class="clearfix entry-content">
      <template v-for="item in portfoliowork">
        <a :href="item.link" class="pointer">
          <div class="view view-fifth">
            <!-- {{item.img}} -->
            <!-- <img src="{`item.img`}" alt="" /> -->
            <img :src="item.img" />
            <div class="mask">
              <h3>{{ item.header }}</h3>
              <p>{{ item.text }}</p>
            </div>
          </div>
        </a>
      </template>
    </div>
    <br />
    <p>It's closed websites:</p>
    <div class="clearfix entry-content">
      <template v-for="item in portfolioclose">
        <a :href="item.link" class="pointer">
          <div class="view view-fifth">
            <!-- {{item.img}} -->
            <!-- <img src="{`item.img`}" alt="" /> -->
            <img :src="item.img" />
            <div class="mask">
              <h3>{{ item.header }}</h3>
              <p>{{ item.text }}</p>
            </div>
          </div>
        </a>
      </template>
    </div>
  </div>
</template>
    <script>
export default {
  props: ["portfoliowork", "portfolioclose"],
  data: function () {
    return {
      urlFromDataBase: this.mainmenulinks,
      currentPage: "/",
      title: "Open journal system developer",
    };
  },
};
</script>
<style>
.view {
  width: 300px;
  height: 270px;
  margin: 10px;
  float: left;
  border: 6px solid #fff;
  overflow: hidden;
  position: relative;
  text-align: center;
  -webkit-box-shadow: 1px 1px 2px #e6e6e6;
  -moz-box-shadow: 1px 1px 2px #e6e6e6;
  box-shadow: 1px 1px 2px #e6e6e6;
  cursor: default;
  background: black;
  background: #fff url("/img/old-portfolio/bgimg.jpg") no-repeat center center;
}

.view .mask,
.view .content {
  width: 300px;
  height: 270px;
  position: absolute;
  overflow: hidden;
  top: 0;
  left: 0;
}

.view-fifth .mask {
  background-color: rgba(146, 96, 91, 0.3);
  -webkit-transform: translateX(-300px);
  -moz-transform: translateX(-300px);
  -o-transform: translateX(-300px);
  -ms-transform: translateX(-300px);
  transform: translateX(-300px);
  -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=100)";
  filter: alpha(opacity=100);
  opacity: 1;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
  font-size: 0.9rem;
  padding: 0px 12px 0px 4px;
}

.view img {
  display: block;
  position: relative;
}

.view-fifth img {
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
img {
  width: auto\9;
  height: auto;
  max-width: 100%;
  vertical-align: middle;
  border: 0;
  -ms-interpolation-mode: bicubic;
}

.view-fifth p {
  -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  opacity: 0;
  color: #333;
  -webkit-transition: all 0.2s linear;
  -moz-transition: all 0.2s linear;
  -o-transition: all 0.2s linear;
  -ms-transition: all 0.2s linear;
  transition: all 0.2s linear;
}

.view-fifth:hover .mask {
  -webkit-transform: translateX(0px);
  -moz-transform: translateX(0px);
  -o-transform: translateX(0px);
  -ms-transform: translateX(0px);
  transform: translateX(0px);
}

.view-fifth:hover img {
  -webkit-transform: translateX(300px);
  -moz-transform: translateX(300px);
  -o-transform: translateX(300px);
  -ms-transform: translateX(300px);
  transform: translateX(300px);
}

.view-fifth:hover p {
  -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=100)";
  filter: alpha(opacity=100);
  opacity: 1;
}

.view h3 {
  font-family: Tahoma;
  text-transform: uppercase;
  color: #fff;
  text-align: center;
  position: relative;
  font-size: 17px;
  padding: 10px;
  background: rgba(0, 0, 0, 0.8);
  margin: 10px 0 0 0;
}
</style>