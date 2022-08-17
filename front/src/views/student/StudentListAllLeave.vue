<template>
  <div class="studentListAllLeave">
    <list-all-leave></list-all-leave>
  </div>
</template>

<script>
import AllLeave from "@/components/student/ListAllLeave.vue";
export default {
  components: {
    "list-all-leave": AllLeave,
  },
  data(){
    return {
      student_leaves:[],
    }
  },



  
};
</script>

<style>
</style>