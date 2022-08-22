<template>
  <menu-bar></menu-bar>
</template>

<script>
import MenubarView from "@/components/Menu/MenubarView.vue";

export default {
  components: { 
    "menu-bar": MenubarView,
   
  },
  
};
</script>

<style>
* {
  margin: 0;
  padding: 0;
  font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
}

</style>
