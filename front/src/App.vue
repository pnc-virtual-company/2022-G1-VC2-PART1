<template>
  <menu-bar></menu-bar>
</template>

<script>
import MenubarView from "@/components/Menu/MenubarView.vue";
export default {
  data() {
    return {

    };
  },
  components: { "menu-bar": MenubarView,},
  methods: {
  },
};
</script>

<style>
* {
  margin: 0;
  padding: 0;
  font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
}
nav {
  display: flex;
  justify-content: space-between;
  background: #144e5a;
  padding: 15px;
}

nav a {
  color: #fff;
  font-size: larger;
  text-decoration: none;
  padding: 5px;
  margin: 10px;
}
nav a:first-child {
  margin-left: 25px;
}
nav a:last-child {
  margin-right: 20px;
}
.welcome {
  font-weight: bold;
}
nav a:hover{
  color: orange;
}
nav a.router-link-exact-active {
  border-bottom: 2px solid orange;
}
</style>
