<template>
  <section>
    <nav v-if="isAdmin">
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
        <img src="../../assets/lolo.jpg" alt="" class="profile-image" />
        <router-link to="/profile">VANSAO HANG</router-link>

        <router-link to="/signOut" class="signOut">
          <i class="fa fa-sign-out fa-2x"></i>
        </router-link>
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
      isStudent: false,
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
  background: rgb(233, 233, 233);
  box-shadow: 2px 4px 6px 1px #aaa;
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