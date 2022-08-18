<template>
  <profile-view :student="profile"></profile-view>
</template>

<script>
import http from '../../axios-http'
import StudentProfile from "@/components/student/StudentProfileView.vue"
export default({
  components:{"profile-view":StudentProfile},
  data(){
    return{
      profile:{}
    }
  },
  methods:{
    getStudentProfile(){
      http.get("student/1").then(restul =>(this.profile=restul.data[0]))
    }
  },
  mounted(){
    this.getStudentProfile()
  }
})
</script>
