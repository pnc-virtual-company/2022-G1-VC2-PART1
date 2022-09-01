<template>
  <TeacherProfile-view></TeacherProfile-view>
</template>

<script>
import axios from "../../axios-http";
import TeacherProfile from "@/components/teacher/TeacherProfileView.vue";
export default {
  components: { "TeacherProfile-view": TeacherProfile },

  data() {
    return {
      profile: {},
    };
  },
  methods:{
    getTeacherProfile(){
      axios.get("userlogin").then(result => {this.profile=result.data[0]; console.log(this.profile);})
      
    },


  mounted() {
    this.getTeacherProfile();
  },
},
};
</script>
