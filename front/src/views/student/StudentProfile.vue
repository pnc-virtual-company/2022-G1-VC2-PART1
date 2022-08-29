<template>
  <profile-view></profile-view>
</template>

<script>
import StudentProfile from "@/components/student/StudentProfileView.vue";
 import axios from "@/axios-http";
export default {
  components: { "profile-view": StudentProfile },

  data() {
    return {
      profile: {},
    };
  },
  methods:{
    getStudentProfile(){
      axios.get("student/1").then(result => {this.profile=result.data[0]})
    },
    update(newpassword){
      axios.put("student/1", newpassword)
      .then(result =>(console.log("Student Updated", result.data)));
    },
  methods: {
    getStudentProfile() {
      axios.get("student/9").then((result) => {
        this.profile = result.data[0];
      });
    },
  },

  mounted() {
    this.getStudentProfile();
  },
},
};
</script>
