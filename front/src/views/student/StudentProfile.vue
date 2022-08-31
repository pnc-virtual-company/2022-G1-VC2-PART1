<template>
  <StudentProfile-view></StudentProfile-view>
</template>

<script>
import StudentProfile from "@/components/student/StudentProfileView.vue";
 import axios from "@/axios-http";
export default {
  components: { "StudentProfile-view": StudentProfile },

  data() {
    return {
      profile: {},
    };
  },
  methods:{
    getStudentProfile(){
      axios.get("userlogin").then(result => {this.profile=result.data[0]; console.log(this.profile);})
      
    },


  mounted() {
    this.getStudentProfile();
  },
},
};
</script>
