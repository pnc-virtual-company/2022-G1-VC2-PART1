<template>
  <section>
    <menu-bar></menu-bar>
    <sign-in
    ></sign-in>
  </section>
</template>

<script>
import MenubarView from "@/components/Menu/MenubarView.vue";
import SignIn from "./views/SignIn.vue"
export default {
  components: { 
    "menu-bar": MenubarView,
    "sign-in" : SignIn,
  },

  data(){
    return {
      role:null,
    }
  },

  methods:{
    sigined(userRole){
      this.role = userRole;
      console.log("User role is ", this.role);
    }
  }
};
</script>

<style>
* {
  margin: 0;
  padding: 0;
  font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
}

</style>
