<template>
  <div class="studentsList">
    <student-list
      @addStudent="addStudent"
      @updateStudent="updateStudent"
      v-if="!dialog"
    ></student-list>
    <add-student
      @add-student="showListStudents"
      @cancele-add="canceleAddStudent"
      v-if="dialog && infor == null"
    ></add-student>

  </div>
</template>

<script>
import StudentList from "../../components/teacher/StudentList.vue";
import AddStudents from "../../components/teacher/AddStudent.vue";
import http from "@/axios-http";
export default {
  components: {
    "student-list": StudentList,
    "add-student": AddStudents,
  },

  data() {
    return {
      dialog: false,
      infor: null,
    };
  },

  methods: {
    addStudent(student) {
      this.dialog = student;
      console.log("Text" + student);
    },

    showListStudents(show) {
      this.dialog = show;
    },

    updateStudent(student){
      console.log("StudentID", student.update_id, "Infor: ", student.infor);
      http.put("student/"+student.update_id, student.infor).then(response =>{console.log(response)})
    },
    canceleAddStudent(hide) {
      this.dialog = hide;
    },

  }

};
</script>

<style>
</style>