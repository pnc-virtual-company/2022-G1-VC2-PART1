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
      http.get("student/1").then(result => {this.profile=result.data[0]})
    },
    update(newpassword){
      http.put("student/1", newpassword)
      .then(result =>(console.log("Student Updated", result.data)));
    }
  },
   
  mounted(){
    this.getStudentProfile()
  }
 
})
</script>
