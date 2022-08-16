<template>
  <nav v-if="isAdmin">
    <div class="nav-controll">
      <router-link to="/welcome" class="welcome">SLMS</router-link>
      <router-link to="/studentsList">Student List</router-link>
      <router-link to="/checkLeave">Check Leave</router-link>
    </div>
    <div class="nav-controll">
      <router-link to="/userInfo">Username</router-link>
      <router-link to="/signOut">Sign Out</router-link>
    </div>
  </nav>
  <nav v-if="isStudent">
    <div class="nav-controll">
      <router-link to="/welcome" class="welcome">SLMS</router-link>
      <router-link to="/studentListAllLeave">List all leave</router-link>
      <router-link to="/newRequest">New Request</router-link>
    </div>
    <div class="nav-controll">
      <router-link to="/userInfo">Username</router-link>
      <router-link to="/signOut">Sign Out</router-link>
    </div>
  </nav>
  <router-view />
  <button @click="adminlogIn()" v-if="isLogIn" class="btn">Teacher</button>
  <button @click="studentLogIn()" v-if="isLogIn" class="btn">Student</button>
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
.btn {
  padding: 10px;
  margin: 10px;
  
}
</style>