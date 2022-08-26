<template>
  <section>
    <div class="cotainer_filter">
      <div class="status_type">
        <span>Filter by Status: </span>
        <select class="select_controll" v-model="status_type">
          <option value="show all" selected>Show all</option>
          <option value="approved">Approved</option>
          <option value="padding">Padding</option>
          <option value="rejected">Rejected</option>
        </select>
      </div>
      <div class="leave_type">
        <span>Filter by Type: </span>
        <select class="select_controll" v-model="leave_type">
          <option value="show all" selected>Show all</option>
          <option value="family event">Family Event</option>
          <option value="check health">Check Health</option>
          <option value="sick">Sick</option>
          <option value="ceremony event">Ceremony Event</option>
          <option value="brother/sister married">brother/sister married</option>
        </select>
      </div>
      <button @click="studentEachStatus" class="btn-search">Search</button>
    </div>

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
            <th>{{ student.created_at }}</th>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</template>
<script>
import http from "../../axios-http";
export default {
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
      http.get("/student/leaveRequest/9").then((result) => {
        this.student_leaves = result.data;
        this.students = this.student_leaves;
      });
    },
    studentEachStatus() {
      this.students = this.student_leaves;
      if (this.status_type != "show all") {
        const lists = this.student_leaves.filter(
          (students) => students.status.toLowerCase() == this.status_type
        );
        if (this.leave_type != "show all") {
          this.students = lists.filter(
            (students) => students.leave_type.toLowerCase() == this.leave_type
          );
        }
      } else if (this.leave_type != "show all") {
        this.students = this.student_leaves.filter(
          (students) => students.leave_type.toLowerCase() == this.leave_type
        );
      }
      if (this.leave_type != "show all") {
        const lists = this.student_leaves.filter(
          (students) => students.leave_type.toLowerCase() == this.leave_type
        );
        if (this.status_type != "show all") {
          this.students = lists.filter(
            (students) => students.status.toLowerCase() == this.status_type
          );
        }
      } else if (this.status_type != "show all") {
        this.students = this.student_leaves.filter(
          (students) => students.status.toLowerCase() == this.status_type
        );
      }
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
  width: 85%;
  margin: 2rem auto;
}
.status_type,
.leave_type {
  padding: 10px 0px;
  width: 44%;
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
  margin-top: 20px;
}
.btn-search {
  display: flex;
  align-items: center;
  height: 1.8rem;
  margin-left: 4px;
  margin-top: 3rem;
  padding: 20px 30px;
  border-radius: 5px;
  border: none;
  background-color: #FF9620;
  color: white;
}
span{
  padding: 10px;
  font-size: large;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 2vh;
  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
  font-size: 13px;
}

tr,
th,
td {
  padding: 10px;
  font-weight: 100;
  font-size: 15px;
}

thead tr th {
  background-color: #23BBEA;
  color: #fff;
  padding: 15px;
  font-size: 15px;
  font-weight: 600;
}
tbody tr:hover{
    background-color:rgba(100, 100, 111, 0.2);
}
.padding {
  color: #ffba07;
}
.approved {
  color: #3e9e10;
}
.rejected {
  color: #fe0000;
}
</style>