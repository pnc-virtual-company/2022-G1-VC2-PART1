<template>
  <section>
    <nav v-if="role == true">
      <div class="nav-controll nav-left">
        <div class="pnc_logo">
          <img src="../../assets/pnc_logo.png" alt="" />
        </div>
        <router-link to="/welcome" class="welcome">PNC SLMS</router-link>
      </div>
      <div class="nav-controll nav-center">
        <router-link to="/studentsList">PEOPLE</router-link>
        <router-link to="/checkLeave">CHECK LEAVES</router-link>
      </div>
      <div class="nav-controll nav-right" v-if="userData.image != undefined">
        <img
          :src="'http://127.0.0.1:8000/storage/pictures/' + userData.image"
          alt=""
          class="profile-image"
        />
        <router-link to="/TeacherProfile"
          >{{ userData.firstname }} {{ userData.lastname }}</router-link
        >
        <div class="signOut">
          <i class="fa fa-sign-out fa-2x" @click="userSignOut"></i>
        </div>
      </div>
    </nav>
    <nav v-if="role == false">
      <div class="nav-controll nav-left">
        <div class="pnc_logo">
          <img src="@/assets/pnc_logo.png" alt=""/>
        </div>
        <router-link to="/" class="welcome">PNC SLMS</router-link>
      </div>
      <div class="nav-controll nav-center">
        <router-link to="/newRequest">REQUEST LEAVE</router-link>
        <router-link to="/studentListAllLeave">HISTORY</router-link>
      </div>
      <div class="nav-controll nav-right" v-if="userData.image != undefined">
        <img
          :src="'http://127.0.0.1:8000/storage/pictures/' + userData.image"
          alt=""
          class="profile-image"
        />
        <router-link to="/studentprofile"
          >{{ userData.firstname }} {{ userData.lastname }}</router-link
        >
        <div class="signOut">
          <i class="fa fa-sign-out fa-2x" @click="userSignOut"></i>
        </div>
        </div>
  
      </nav>
      <!-- </div>
    </nav> -->
  </section>
</template>
<script>
export default {
  data(){
    return{
      username:null,
      image:null,
    }
  },
  emits: ["sign-out"],
  props: ["role", "userData"],
  methods: {
    userSignOut() {
      this.$emit("sign-out");
    },
  },
};
</script>

<style scoped>
section{
  background:#fff;
  position: sticky;
  top: 0;
}
nav {
  display: flex;
  justify-content: space-between;
  box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px,
    rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
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
  
  border-radius: 50%;
  border: 2px solid orange;
  width: 40px;
  height: 40px;
  display: flex;
  margin-top: 7px;
}
.signOut {
  padding: 7px 0;
}
i {
  color: #2ea3f2;
  margin-left: 10px;
}
</style>
