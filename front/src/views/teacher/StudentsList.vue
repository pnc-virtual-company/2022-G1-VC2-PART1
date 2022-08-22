<template>
  <div class="studentsList">
    <student-list @add-Student="addStudent" v-if="!dialog"></student-list>
    <add-student @add-Student = "showListStudents" v-if="dialog"></add-student>
  </div>
</template>

<script>
import StudentList from "../../components/teacher/StudentList.vue"
import AddStudents from "../../components/teacher/AddStudent.vue"
export default {
  components: {
    "student-list":StudentList,
    "add-student":AddStudents
  },

  data(){
    return{
      dialog:false
    }
  },

  methods:{
    addStudent(student){
      this.dialog = student
      console.log("Text" + student)
    },

    showListStudents(show){
      this.dialog = show;
    }
  }

}
</script>

<style>

</style>