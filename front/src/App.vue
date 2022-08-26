<template>
  <section>
    <menu-bar v-if="role!=null"></menu-bar>
    <sign-in v-if="role==null"
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
    
  },
  computed:{
    role(){
      if(localStorage.getItem("user_role")){
        return localStorage.getItem("user_role")
      }else{
        return null
      }
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
