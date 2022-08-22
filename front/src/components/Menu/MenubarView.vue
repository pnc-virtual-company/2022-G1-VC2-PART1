<template>
  <section>
    <nav v-if="isAdmin">
      <div class="nav-controll">
        <router-link to="/welcome" class="welcome">SLMS</router-link>
        <router-link to="/studentsList">Student List</router-link>
        <router-link to="/checkLeave">Check Leave</router-link>
      </div>
      <div class="nav-controll">
        <router-link to="/profile">Username</router-link>
        <router-link to="/signOut">Sign Out</router-link>
      </div>
    </nav>
    <nav v-if="isStudent">
      <div class="nav-controll nav-left">
        <div class="pnc_logo">
          <img src="../../assets/pnc_logo.png" alt="" />
        </div>
        <router-link to="/welcome" class="welcome">PNC SLMS</router-link>
      </div>
      <div class="nav-controll nav-center">
        <router-link to="/newRequest">REQUEST LEAVE</router-link>
        <router-link to="/studentListAllLeave">HISTORY</router-link>
      </div>
      <div class="nav-controll nav-right">
        <img src="../../assets/lolo.jpg" alt="" class="profile-image" />
        <router-link to="/profile">VANSAO HANG</router-link>

        <router-link to="/signOut" class="signOut">
          <i class="fa fa-sign-out fa-2x"></i>
        </router-link>
      </div>
    </nav>
    <router-view />
    <button @click="adminlogIn()" v-if="isLogIn" class="btn">Teacher</button>
    <button @click="studentLogIn()" v-if="isLogIn" class="btn">Student</button>
  </section>
</template>

<script>
export default {
  data() {
    return {
      isAdmin: false,
      isStudent: true,
      isLogIn: true,
    };
  },
  methods: {
    adminlogIn() {
      this.isAdmin = true;
      this.isLogIn = false;
    },
    studentLogIn() {
      this.isStudent = true;
      this.isLogIn = false;
    },
  },
};
</script>

<style scoped>
nav {
  display: flex;
  justify-content: space-between;
  background: #144e5a;
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
  color: #fff;
  font-size: larger;
  text-decoration: none;
  margin: 0 15px;
  margin-top: 5px;
  padding: 15px 0;
}
.welcome {
  font-weight: bold;
  font-size: x-large;
}
nav a:hover {
  color: orange;
}
nav a.router-link-exact-active {
  border-bottom: 2px solid orange;
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
  color: orange;
  margin-left: 10px;
}
</style>