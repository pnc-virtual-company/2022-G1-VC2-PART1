<template>
  <nav>
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
</template>

<script>
export default {};
</script>

<style>
</style>