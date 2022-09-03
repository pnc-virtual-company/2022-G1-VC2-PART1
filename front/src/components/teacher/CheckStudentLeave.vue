<!--                                            All Update                             -->
<template>
  <section style="display: flex; flex-direction: column">
    <!-- Filter students leave by leave status -->

    <div class="filter_container">
      <div class="all_filter filter" @click="getlistOfStudentsLeave('all')">
        <p>ALL</p>
        <h2>{{listOfStudentsLeaveFilter.length}}</h2>
      </div>
      <div
        class="padding_filter filter"
        @click="getlistOfStudentsLeave('padding')"
      >
        <p>Padding</p>
        <h2>{{ filterPadding }}</h2>
      </div>
      <div
        class="approved_filter filter"
        @click="getlistOfStudentsLeave('approved')"
      >
        <p>Approved</p>
        <h2>{{filterApproved }}</h2>
      </div>
      <div
        class="rejected_filter filter"
        @click="getlistOfStudentsLeave('rejected')"
      >
        <p>Rejected</p>
        <h2>{{ filterRejected }}</h2>
      </div>
    </div>

    <!------------- list all students' leaves ------------->
    <div class="student-leave" v-if="!seen">
      <h1>{{studentLeaveText}}</h1>
      <div v-for="leave of listOfStudentsLeave" :key="leave">
        <div
          class="students-card"
          v-if="!seen"
          :class="'border-' + leave.status.toLowerCase()"
        >
          <div class="card" @click="getAleave(leave.id)">
            <div class="student">
              <div class="student-profile">
                <img
                  :src="
                    'http://127.0.0.1:8000/storage/pictures/' +
                    leave.student.image
                  "
                  alt=""
                />
              </div>
              <div class="student-info">
                <h4>
                  {{ leave.student.lastname }} {{ leave.student.firstname }}
                </h4>
                <p>{{ leave.student.class }} {{ leave.student.batch }}</p>
              </div>
            </div>
            <div class="stauts">
              <h4 :class="leave.status.toLowerCase()">{{ leave.status }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-------------------------- Student Leave Details -------------------->
    <div v-if="seen" class="leave">
      <div class="leave-card" v-for="leave of listOfALeave" :key="leave">
        <div class="detail-card">
          <div class="student-infor">
            <div class="student-profile-detail" style="display: flex">
              <img
                :src="
                  'http://127.0.0.1:8000/storage/pictures/' +
                  leave.student.image
                "
                alt=""
              />
              <div class="student-info">
                <h3>
                  {{ leave.student.lastname }} {{ leave.student.firstname }}
                </h3>
                <p>{{ leave.student.class }} {{ leave.student.batch }}</p>
              </div>
            </div>
            <div class="cancelIcon">
              <img src="@/assets/x-mark.png" alt="" @click="seen = !seen" />
            </div>
          </div>
          <div class="leave-info">
            <div class="leave-date">
              <div>
                <h5>Start date:</h5>
                <p>{{ leave.start_date }}</p>
              </div>
              <div>
                <h5>End date:</h5>
                <p>{{ leave.end_date }}</p>
              </div>
              <div>
                <h5>Duration :</h5>
                <p>{{ leave.duration }} days</p>
              </div>
              <div>
                <h5>Request date:</h5>
                <p>{{ leave.created_at }}</p>
              </div>
            </div>
            <div class="leave-text">
              <div>
                <h5>Leave Type :</h5>
                <p>{{ leave.leave_type }}</p>
              </div>
              <div class="textArea">
                <h5>Reason:</h5>
                <p>{{ leave.reason }}</p>
              </div>
              <div>
                <h5>Status :</h5>
                <p :class="leave.status.toLowerCase()" id="status-detail">
                  {{ leave.status }}
                </p>
              </div>
            </div>
          </div>
          <div class="btn" v-if="leave.status === 'Padding'">
            <button
              @click="updateAproved(leave)"
              class="btn-aproved"
              type="button"
            >
              Aproved
            </button>
            <button
              @click="updateReject(leave)"
              class="btn-reject"
              type="button"
            >
              Reject
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import axios from "@/axios-http";
import swal from "sweetalert";
export default {
  data() {
    return {
      seen: false,
      listOfStudentsLeave: [],
      listOfStudentsLeaveFilter: [],
      listOfALeave: [],
      filter_padding: 0,
      studentLeaveText :'Student Leaves'
    };
  },
  methods: {
    getlistOfStudentsLeave(status) {
      console.log(status);
      axios.get("student_leave_request").then((res) => {
        this.listOfStudentsLeave = res.data;
        this.listOfStudentsLeaveFilter = res.data;
        this.studentLeaveText = 'Student Leaves'
        if (status != "all") {
          this.studentLeaveText += ' ' + status;
          this.listOfStudentsLeave = res.data.filter(
            (leave) => leave.status.toLowerCase() == status
          );
        }
      });
    },
    getAleave(id) {
      axios.get("student_leave_request/" + id).then((res) => {
        this.listOfALeave = res.data;
        this.seen = !this.seen;
      });
    },
    updateReject(leave) {
      axios
        .put("student_leave_request/" + leave.id, { status: "Rejected" })
        .then((res) => {
          this.getAleave(leave.id);
          this.getlistOfStudentsLeave();
          axios.get("responeMail/" + leave.id);
          return res.data;
        });
      console.log(this.listOfALeave[0].student.email);

      swal("Rejected!", "You rejected this leave request !", "success");
    },
    updateAproved(leave) {
      axios
        .put("student_leave_request/" + leave.id, { status: "Approved" })
        .then((res) => {
          this.getAleave(leave.id);
          this.getlistOfStudentsLeave();
          axios.get("responeMail/" + leave.id);
          return res.data;
        });
      swal("Approved!", "You approved this leave request !", "success").then(
        () => {}
      );
    },
    filter(status) {
      this.getlistOfStudentsLeave();
      let result = [];
      result = this.listOfStudentsLeave.filter(
        (leave) => leave.status.toLowerCase() == status
      );
      this.listOfStudentsLeave = result;
      return result;
    },
  },
  computed: {
    filterPadding: function () {
      let result = 0;
      for (let leave of this.listOfStudentsLeaveFilter) {
        console.log(leave.status);
        if (leave.status.toLowerCase() == "padding") {
          result += 1;
        }
      }
      return result;
    },
    filterApproved: function () {
      let result = 0;
      for (let leave of this.listOfStudentsLeaveFilter) {
        console.log(leave.status);
        if (leave.status.toLowerCase() == "approved") {
          result += 1;
        }
      }
      return result;
    },
    filterRejected: function () {
      let result = 0;
      for (let leave of this.listOfStudentsLeaveFilter) {
        console.log(leave.status);
        if (leave.status.toLowerCase() == "rejected") {
          result += 1;
        }
      }
      return result;
    },
  },
  mounted() {
    this.getlistOfStudentsLeave("all");
  },
};
</script>
  
  <style scoped>
section {
  display: flex;
  justify-content: center;
}
.student-leave {
  width: 60%;
  margin-top: 2rem;
  border-radius: 5px;
  border: 0.5px solid rgb(195, 195, 195);
  margin: auto;
}
.leave {
  width: 60%;
  margin-right: 5rem;
  margin: auto;
}
.student-leave h1 {
  padding: 15px;
  font-size: 1.5rem;
  color: white;
  border-radius: 5px 5px 0 0;
  background: #23bbea;
}
.students-card {
  border: 0.5px solid rgb(195, 195, 195);
  margin: 1rem;
  border-radius: 5px;
  cursor: pointer;
}
.card {
  display: flex;
  justify-content: space-between;
  margin-right: 10px;
}
.student {
  display: flex;
}
.student-infor {
  background: #23bbea;
  border-radius: 5px 5px 0 0;
  margin-top: -17px;
  display: flex;
  justify-content: space-between;
  padding: 0.5rem 1.7rem 0.5rem 1.7rem;
}
.student-profile-detail img {
  width: 3rem;
  height: 3rem;
  background: #000;
  border-radius: 50%;
  margin-left: 10px;
  margin-top: 2px;
}
.student-info {
  margin-top: 25px;
  margin-left: 20px;
}
.student-info p {
  font-size: 0.9rem;
}
.padding {
  color: #ff9620;
}
.approved {
  color: green;
}
.rejected {
  color: red;
}
.padding,
.approved,
.rejected {
  margin-top: 2.5rem;
}
.border-padding {
  border-left: 3px solid #ff9620;
}
.border-approved {
  border-left: 3px solid rgb(13, 236, 13);
}
.border-rejected {
  border-left: 3px solid red;
}
.student-profile {
  padding: 0.5rem;
}
.student-profile img {
  width: 3.5rem;
  height: 3.5rem;
  border-radius: 50%;
}
/* Detail information style */

.detail-card {
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  margin: 30px;
  border-radius: 5px;
  width: 100%;
}
.leave-info {
  display: flex;
  justify-content: space-between;
  margin: 10px;
  justify-content: space-around;
}
.leave-date {
  width: 45%;
  margin-left: 1rem;
}
.leave-text {
  width: 50%;
}
.leave-date div,
.leave-text div {
  display: flex;
  padding: 0.5rem;
  margin: 10px;
}

.leave-date p,
.leave-text p {
  margin-left: 4px;
}
.leave-date h5,
.leave-text h5 {
  font-size: 1.1rem;
  line-height: -10px;
}
.textArea {
  line-height: 1.7rem;
}
.btn {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  margin: 0 2.3rem 0 0;
}
.btn-aproved {
  background: #23bbea;
}
.btn-reject {
  background: #ff9620;
  margin-left: 1rem;
}
.btn-aproved,
.btn-reject {
  color: white;
  border: none;
  padding: 10px;
  width: 5rem;
  border-radius: 10px;
  font-size: 15px;
  margin-bottom: 2rem;
  cursor: pointer;
}
.cancelIcon img {
  width: 2.2rem;
  height: 2.2rem;
  cursor: pointer;
  padding: 4px;
}
#status-detail {
  font-weight: 800;
  margin-top: -3px;
}

/* <!-- Filter students leave by leave status --> */
.filter_container {
  width: 60%;
  margin: auto;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 0 1rem 0;
}
.filter {
  width: 22%;
  height: 15vh;
  border-radius: 5px;
  background: rgb(233, 233, 233);
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  cursor: pointer;
}
.filter h2 {
  text-align: center;
  margin-top: 1rem;
}
.filter p {
  width: 100%;
  height: 5vh;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 5px 5px 0 0;
  font-weight: 550;
  background: #23bbea;
}
</style>
  <!--                                                    End Updated                                 -->