<template>
  <section>
    <menu-bar :role="role" :userData="userData"></menu-bar>
    <router-view @sign-in="login"> </router-view>
  </section>
</template>
<script>
import MenubarView from "@/components/Menu/MenubarView.vue";
import axios from "./axios-http";
export default {
  data() {
    return {
      role: "",
      userData: {},
    };
  },
  components: {
    "menu-bar": MenubarView,
  },
  methods: {
    getUserData() {
      if (localStorage.accessToken) {
        axios.get("userlogin").then((res) => {
          this.userData = res.data;
          this.role = this.userData.role;
          console.log(this.userData.firstname, this.userData.lastname);
        });
      }
      //  else {
      //   this.$router.push("/");
      // }
    },
    login(userData) {
      axios.post("user/sigin", userData).then((response) => {
        this.role = response.data.user.role;
        localStorage.setItem("accessToken", response.data.token);
        this.getUserData();
        this.$router.push("/welcome");
      });
    },
  },
  mounted() {
    this.getUserData();
    this.$router.push("/");
    if (localStorage.getItem("accessToken") === null) {
      console.log(localStorage.getItem("accessToken"))
      this.$router.push("/");
    } else {
      this.$router.push("/welcome");
    }
  },
};
</script>

<style>
* {
  margin: 0;
  padding: 0;
  font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
}
</style>
