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
  methods:{
    parameterRouter(){
      console.log(this.$router.currentRoute.path);
    }
  }

  
};
</script>
