<template>
  <TeacherProfile-view></TeacherProfile-view>
</template>

<script>
import TeacherProfile from "@/components/teacher/TeacherProfileView.vue";
export default {
  components: { "TeacherProfile-view": TeacherProfile },
<<<<<<< HEAD
=======

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
>>>>>>> 494c6ab2a07b20a7f53f37840d75e3b3bf3f68c9
};
</script>
