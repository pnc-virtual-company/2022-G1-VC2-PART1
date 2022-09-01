<!--                                            All Update                             -->
<template>
  <section>
    <div class="student-leave" v-if="!seen">
      <h1>Student Leave</h1>
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
        listOfALeave: [],
      };
    },
    methods: {
      getlistOfStudentsLeave() {
        axios.get("student_leave_request").then((res) => {
          this.listOfStudentsLeave = res.data;
          console.log(this.listOfStudentsLeave.reverse());
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
            return res.data;
          });
          swal("Rejected!", "You rejected this leave request !", "success").then(()=>{
            this.getAleave(leave.id);
            this.getlistOfStudentsLeave();
          });
      },
      updateAproved(leave) {
        axios
          .put("student_leave_request/" + leave.id, { status: "Approved" })
          .then((res) => {
            return res.data;
          });
          swal("Approved!", "You approved this leave request !", "success").then(()=>{
            this.getAleave(leave.id);
            this.getlistOfStudentsLeave();
          });
      },
    },
    mounted() {
      this.getlistOfStudentsLeave();
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
  }
  .leave {
    width: 60%;
    margin-right: 5rem;
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
  </style>
  <!--                                                    End Updated                                 -->