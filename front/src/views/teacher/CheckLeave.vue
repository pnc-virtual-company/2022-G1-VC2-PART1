<template>
  <form>
    <h1>Student Leave</h1>
    <div v-if="!seen">
      <div
        class="checkLeave"
        v-for="(student, index) of listOfStudentsLeave"
        :key="student"
        @click="seen = !seen"
      >
        <p style="display: none">{{ index }}</p>
        <div class="student_infor">
          <img src="../../assets/koko.jpg" alt="" />
          <h2 class="name_stu">Samoul Kh</h2>
        </div>
        <div class="reson_data" @click="show(student)">
          <div class="status">{{ student.status }}</div>
          <div class="dete">{{ student.request_date }}</div>
        </div>
      </div>
    </div>
    <div v-if="seen" id="hide">
      <div class="userInfo">
        <div class="profile">
          <div class="imgBx">
            <img src="@/assets/lolo.jpg" />
          </div>
          <div class="container">
            <div class="data">
              <h3>Leave type: {{ studentDetail.leave_type }}</h3>
              <h3>Start_date: {{ studentDetail.start_date }}</h3>
              <h3>End_date: {{ studentDetail.end_date }}</h3>
              <h3>Duration: {{ studentDetail.duration }}</h3>
              <h3>Status: {{ studentDetail.status }}</h3>
              <h3>Request_date: {{ studentDetail.request_date }}</h3>
              <h3>Reason: {{ studentDetail.reason }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import http from "../../axios-http";
export default {
  data() {
    return {
      seen: false,
      studentDetail: {},
      listOfStudentsLeave: [],
    };
  },

  methods: {
    getlistOfStudentsLeave() {
      http.get("studentleaveRequest").then((res) => {
        (this.listOfStudentsLeave = res.data),
          console.log(this.listOfStudentsLeave);
      });
    },
    show(student) {
      this.studentDetail = student;
      console.log(student);
    },
  },

  mounted() {
    this.getlistOfStudentsLeave();
  },
};
</script>

<style scoped>
.checkLeave {
  display: flex;
  justify-content: space-between;
  margin: auto;
  cursor: pointer;
  background: #e1e7ea;
  width: 70%;
  height: 110px;
  border-radius: 10px;
  border-left: 2px solid orange;
  padding: 5px;
  margin-bottom: 10px;
}
.student_infor {
  display: flex;
}
.checkLeave .student_infor img {
  height: 90px;
  height: 90px;
  border-radius: 50%;
  margin-left: 10px;
  object-fit: cover;
  border: 2px solid orange;
  display: flex;
  align-items: center;
  transition: 0.5s;
}
.checkLeave .student_infor img:hover {
  transform: scale(1.1);
}
.checkLeave .student_infor h2 {
  display: flex;
  align-items: center;
  margin: 10px;
}
.status {
  color: orange;
}
.name_stu {
  color: rgb(38, 140, 190);
}
.checkLeave .reson_data {
  display: flex;
  align-items: flex-end;
}
h1 {
  display: flex;
  justify-content: center;
  padding: 10px;
  color: rgb(38, 140, 190);
}
form {
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.25);
  width: 60%;
  margin: auto;
}

/* <<<<<<< HEAD
.userInfo {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}
.profile {
  position: relative;
  width: 350px;
  height: 160px;
  background: #e1e7ea;
  border-radius: 20px;
  box-shadow: 0 35px 80px rgba(0, 0, 0, 0.15);
}
======= */


.imgBx img{
  position: absolute;
  width: 150px;
  height: 150px;
  background: #fff;
  border-radius: 20px;
  box-shadow: 0 15px 50px rgba(0, 0, 0, 0.35);
}





</style>
