<template>
  <profile-view :profile="profile" @updatePassword="update"></profile-view>
</template>

<script>
import http from '../../axios-http'
import StudentProfile from "@/components/student/StudentProfileView.vue"

export default({
  components:{"profile-view":StudentProfile},
  
  data(){
    return{
      profile:{},
    }
  },
 
   
  methods:{
    getStudentProfile(){
<<<<<<< HEAD
      http.get("student/2").then(result => {this.profile=result.data[0]})
=======
      http.get("student/3").then(result => {this.profile = result.data[0]})
>>>>>>> 9a65a0f41bdc28e5aa0bc334b1c85bf0d30a6aa4
    },
    update(newpassword){
      http.put("student/2", newpassword)
      .then(result =>(console.log("Student Updated", result.data)));
    }
  },
   
  mounted(){
    this.getStudentProfile()
  }
 
})
</script>
