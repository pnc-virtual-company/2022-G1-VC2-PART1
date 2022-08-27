<template>
  <section>
    <nav v-if="role==null">
      <router-link to="/"></router-link>
    </nav>
    <nav v-if="role == 'admin'">
      <div class="nav-controll nav-left">
        <div class="pnc_logo">
          <img src="../../assets/pnc_logo.png" alt="" />
        </div>
        <router-link to="/welcome" class="welcome">PNC SLMS</router-link>
      </div>
      <div class="nav-controll nav-center">
        <router-link to="/studentsList">STUDENTS</router-link>
        <router-link to="/checkLeave">CHECK LEAVES</router-link>
      </div>
      <div class="nav-controll nav-right">
        <img :src="'http://127.0.0.1:8000/storage/pictures/' + profile" alt="" class="profile-image" />
        <router-link to="/profile">{{username}}</router-link>
        <div class="signOut">
          <i class="fa fa-sign-out fa-2x" @click="userSignOut"></i>
        </div>
      </div>
    </nav>
    <nav v-if="role == 'student'">
      <div class="nav-controll nav-left">
        <div class="pnc_logo">
          <img src="../../assets/pnc_logo.png" alt="" />
        </div>
        <router-link to="/" class="welcome">PNC SLMS</router-link>
      </div>
      <div class="nav-controll nav-center">
        <router-link to="/newRequest"
          >REQUEST LEAVE</router-link
        >
        <router-link to="/studentListAllLeave">HISTORY</router-link>
      </div>
      <div class="nav-controll nav-right">
        <img :src="'http://127.0.0.1:8000/storage/pictures/' +profile" alt="" class="profile-image" />
        <router-link to="/profile">{{username}}</router-link>
        <div class="signOut">
          <i class="fa fa-sign-out fa-2x" @click="userSignOut"></i>
        </div>
      </div>
    </nav>
    <router-view/>
  </section>
</template>

<script>
import axios from "@/axios-http"
export default {
  data(){
    return{
      role:null,
    }
  },
  computed: {
    username(){
      let user = JSON.parse(localStorage.getItem("user"))
      return (user.firstname + " " + user.lastname)
    },
    profile(){
      return JSON.parse(localStorage.getItem("user"))["image"]
    },
  },

  methods:{
    get(){
      this.role=localStorage.getItem("user_role");
    },
    userSignOut(){
      axios.post("sigout").then(res => {if(res.data){this.$router.push("/"),localStorage.clear()}})
      setTimeout(() => {window.location.reload()}, 1000)
    }
  },
  mounted(){
    this.get()
  }
};
</script>

<style scoped>
nav {
  display: flex;
  justify-content: space-between;
  /* box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px,
    rgba(27, 31, 35, 0.15) 0px 0px 0px 1px; */
  position: sticky;
  top: 0;
}
.nav-left {
  width: 25%;
}
.nav-left a {
  margin-left: 20px;
}
.nav-right {
  width: 25%;
  display: flex;
  justify-content: center;
}
.nav-right a {
  margin-right: 0px;
}
.nav-center {
  width: 50%;
  display: flex;
  justify-content: center;
}
.nav-controll {
  display: flex;
}
nav a {
  color: #000;
  font-size: 18px;
  text-decoration: none;
  margin: 0 15px;
  margin-top: 5px;
  padding: 15px 0;
}
.welcome {
  font-weight: bold;
}
nav a:hover {
  color: #2ea3f2;
}
nav a.router-link-exact-active {
  border-bottom: 2px solid #2ea3f2;
}
li {
  list-style: none;
}
.btn {
  padding: 10px;
  margin: 10px;
}
.nav-left img {
  margin-top: 5px;
  margin-left: 30px;
  width: 3rem;
  height: 3rem;
}
.profile-image {
  width: 35px;
  height: 35px;
  display: flex;
  margin-top: 13px;
}
.signOut {
  padding: 7px 0;
}
i {
  color: #2ea3f2;
  margin-left: 10px;
}
</style>
