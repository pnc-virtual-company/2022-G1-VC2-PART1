<template>
  <section>
    <menu-bar></menu-bar>
  </section>
</template>
<script>
import MenubarView from "@/components/Menu/MenubarView.vue";
export default {
  components: { 
    "menu-bar": MenubarView,
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
