<template>
  <section>
    <menu-bar :role="role" :userData="userData" @sign-out="signOut"></menu-bar>
    <router-view @sign-in="login" :unauthorizedError="unauthorizedError">
    </router-view>
  </section>
</template>
<script>
import MenubarView from "@/components/Menu/MenubarView.vue";
import axios from "./axios-http";
export default {
  data() {
    return {
      role: null,
      userData: {},
      unauthorizedError: "",
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
          console.log(this.role)
        });
      }

    },
    login(userData) {
      axios
        .post("user/sigin", userData)
        .then((response) => {
          this.role = response.data.user.role;
          localStorage.setItem("accessToken", response.data.token);
          this.getUserData();
          this.unauthorizedError = "";
          this.$router.push("/welcome");
        })
        .catch((error) => {
          console.log(error);
          let serverCode = error.response.status;
          if (serverCode === 401) {
            this.unauthorizedError = "Unauthorized! incorrect email or password";
          }
        });
    },
    signOut() {
      axios.post("sigout").then((res) => {
        if (res.data) {
          this.role = null;
          localStorage.clear();
          this.$router.push("/");
        }
      });
    },
  },
  mounted() {
    this.getUserData();
    if (localStorage.getItem("accessToken") === null) {
      this.$router.push("/");
    } 
    else {
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
