<template>
  <form>
    <h1>Student Leave</h1>
    <div
      class="checkLeave"
      v-for="student of listOfStudentsLeave"
      :key="student"
    >
      <div class="student_infor">
        <img src="../../assets/koko.jpg" alt="" />
        <h2 class="name_stu">Samoul Kh</h2>
      </div>
      <div class="reson_data">
        <div class="status">{{ student.status }}</div>
        <div class="dete">{{ student.request_date }}</div>
      </div>
    </div>
  </form>
</template>

<script>

import http from "../../axios-http";
export default {
  data() {
    return {
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


</style>
