<template>
  <TeacherProfile-view></TeacherProfile-view>
</template>

<script>
import TeacherProfile from "@/components/teacher/TeacherProfileView.vue";
 import axios from "@/axios-http";
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
    // update(newpassword){
    //   axios.put("Teacher/1", newpassword)
    //   .then(result =>(console.log("Teacher Updated", result.data)));
    // },

  mounted() {
    this.getTeacherProfile();
  },
},
};
</script>
