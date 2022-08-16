<template>
  <teacher-menu v-if="isAdmin"></teacher-menu>
  <student-menu v-if="isStudent"></student-menu>
  <button @click="adminlogIn()" v-if="isLogIn">Teacher</button>
  <button @click="studentLogIn()" v-if="isLogIn">Student</button>
</template>

<script>
import TeacherMenu from "@/components/Menu/TeacherMenu.vue";
import StudentMenu from "@/components/Menu/StudentMenu.vue";
export default {
  data() {
    return {
      isAdmin: false,
      isStudent: true,
      isLogIn: true,
      student_leaves:[
        {id:1, student_id:1, start_date:"2022-02-04", end_date:"2022-02-10", current_date:"2022-02-01", status: "Padding", duration:"2", reason:"Visit Family", leave_type:"Family event"},
        {id:2, student_id:2, start_date:"2022-02-04", end_date:"2022-02-10", current_date:"2022-02-01", status: "Padding", duration:"2", reason:"sick", leave_type:"Check health"},
        {id:3, student_id:3, start_date:"2022-02-04", end_date:"2022-02-10", current_date:"2022-02-01", status: "Approved", duration:"2", reason:"Visit hometown", leave_type:"Ceremony event"},
        {id:4, student_id:4, start_date:"2022-02-04", end_date:"2022-02-10", current_date:"2022-02-01", status: "Padding", duration:"2", reason:"Visit Family", leave_type:"Family event"},
        {id:5, student_id:3, start_date:"2022-02-04", end_date:"2022-02-10", current_date:"2022-02-01", status: "Rejected", duration:"2", reason:"sick", leave_type:"Check health"},
        {id:6, student_id:2, start_date:"2022-02-04", end_date:"2022-02-10", current_date:"2022-02-01", status: "Canceled", duration:"2", reason:"Visit Family", leave_type:"Family event"},
        {id:7, student_id:3, start_date:"2022-02-04", end_date:"2022-02-10", current_date:"2022-02-01", status: "Padding", duration:"2", reason:"Visit hometown", leave_type:"Ceremony event"},
      ],
    };
  },
  provide(){
    return {
      student_leaves:this.student_leaves
    }
  },
  components: { "teacher-menu": TeacherMenu, "student-menu": StudentMenu },
  methods: {
    adminlogIn() {
      this.isAdmin = true;
      this.isLogIn = false;
    },
    studentLogIn() {
      this.isStudent = true;
      this.isLogIn = false;
    },
  },
    
  
};
</script>

<style>
* {
  margin: 0;
  padding: 0;
  font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
}
nav {
  display: flex;
  justify-content: space-between;
  background: #144e5a;
  padding: 15px;
}

nav a {
  color: #fff;
  font-size: larger;
  text-decoration: none;
  padding: 5px;
  margin: 10px;
}
nav a:first-child {
  margin-left: 25px;
}
nav a:last-child {
  margin-right: 20px;
}
.welcome {
  font-weight: bold;
}
nav a:hover{
  color: orange;
}
nav a.router-link-exact-active {
  border-bottom: 2px solid orange;
}
</style>
