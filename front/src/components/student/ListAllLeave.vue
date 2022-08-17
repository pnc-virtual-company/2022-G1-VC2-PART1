<template>
  <div class="cotainer_filter">
    <div class="status_type">
      <span>Status Type: </span>
      <select class="select_controll" v-model="status_type">
        <option value="show all" selected>Show all</option>
        <option value="approved">Approved</option>
        <option value="canceled">Canceled</option>
        <option value="padding">Padding</option>
        <option value="rejected">Rejected</option>
      </select>
    </div>
    <div class="leave_type">
      <span>Leave Type: </span>
      <select class="select_controll" v-model="leave_type">
        <option value="show all" selected>Show all</option>
        <option value="family event">Family Event</option>
        <option value="check health">Check Health</option>
        <option value="sick">Sick</option>
        <option value="ceremony event">Ceremony Event</option>
      </select>
    </div>
    <button @click="studentEachStatus" class="btn-search">Search</button>
  </div>
  <section></section>
  <div class="container">
    <table>
      <thead>
        <tr>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Reason</th>
          <th>Duration</th>
          <th>Leave Type</th>
          <th>Status</th>
          <th>Request Date</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for:="student in students">
          <th>{{ student.start_date }}</th>
          <th>{{ student.end_date }}</th>
          <th>{{ student.reason }}</th>
          <th>{{ student.duration }}</th>
          <th>{{ student.leave_type }}</th>
          <th :class="student.status.toLowerCase()">{{ student.status }}</th>
          <th>{{ student.request_date }}</th>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import http from '../../axios-http'

export default {
  // props:{student_leaves:Array},
  data() {
    return {
      student_leaves: [],
      students: [],
      status_type: "show all",
      leave_type: "show all",
    };
  },

  methods: {
    getData() {
      http.get("studentleaveRequest").then((result) => {
        this.student_leaves = result.data;
        this.students = this.student_leaves;
      });
    },
    studentEachStatus() {
      this.students = this.student_leaves;
      if (this.status_type == "show all" || this.leave_type == "show all") {
        this.students = this.student_leaves;
      } else if (this.status_type !== "") {
        this.students = this.student_leaves.filter(
          (students) => students.status.toLowerCase() == this.status_type
        );
      } else if (this.leave_type !== "") {
        this.students = this.student_leaves.filter(
          (students) => students.leave_type.toLowerCase() == this.leave_type
        );
      }
      this.status_type = "";
      this.leave_type = "";
    },
  },
  mounted() {
    this.getData();
  },
};
</script>

<style scoped>
.container {
  width: 85%;
  margin: auto;
}
.cotainer_filter {
  display: flex;
  justify-content: space-between;
  width: 40%;
  margin: 1rem auto;
}
.status_type,
.leave_type {
  padding: 10px 0;
}
.select_controll {
  width: 100%;
  border: none;
  border-radius: 5px;
  box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px,
    rgba(6, 24, 44, 0.65) 0px 4px 6px -1px,
    rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
  padding: 10px;
  outline: none;
}
.btn-search {
  display: flex;
  align-items: center;
  height: 1.8rem;
  margin-left: 4px;
  margin-top: 2rem;
  padding: 15px 20px;
  border-radius: 5px;
  border: none;

  background-color: #144e5a;
  color: white;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 2vh;
}
tr,
th,
td {
  border: 2px solid gray;
  padding: 10px;
}

thead tr th {
  border: 2px solid gray;
  background-color: #144e5a;
  color: #fff;
}
/* tbody tr:hover{
    background-color: skyblue;
} */
.padding {
  color: #ffba07;
}
.approved {
  color: #3e9e10;
}
.rejected {
  color: #fe0000;
}
.canceled {
  color: #1e43c7;
}
</style>