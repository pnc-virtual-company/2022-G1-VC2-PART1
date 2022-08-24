<template>
  <div class="studentsList">
    <student-list @addStudent="addStudent" @updateStudent="updateStudent" v-if="!dialog"></student-list>
    <add-student @add-student = "showListStudents" v-if="dialog && infor==null"></add-student>
  </div>
</template>

<script>
import StudentList from "../../components/teacher/StudentList.vue"
import AddStudents from "../../components/teacher/AddStudent.vue"
import http from "@/axios-http"
export default {
  components: {
    "student-list":StudentList,
    "add-student":AddStudents,
  },

  data(){
    return{
      dialog:false,
      infor:null,
    }
  },

  methods:{
    addStudent(student){
      this.dialog = student
      console.log("Text" + student)
    },

    showListStudents(show){
      this.dialog = show;
    },
    updateStudent(student){
      
      // let updateData=new FormData()
      // updateData.append("username", student.infor.username)
      // updateData.append("email", student.infor.email)
      // updateData.append("password", student.infor.password)
      // updateData.append("gender", student.infor.gender)
      // updateData.append("class", student.infor.class)
      // updateData.append("batch", student.infor.batch)
      // updateData.append("image", student.infor.image)
      console.log("StudentID", student.update_id, "Infor: ", student.infor);
      http.put("student/"+student.update_id, student.infor).then(response =>{console.log(response)})
    } 
  }
}
</script>

<style>

</style>