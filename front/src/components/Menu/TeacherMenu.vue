<template>
  <nav>
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
  <router-view />
</template>

<script>
export default {};
</script>

<style>
</style>