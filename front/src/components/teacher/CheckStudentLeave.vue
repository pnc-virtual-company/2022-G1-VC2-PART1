
<template>
  <section >
    <div class="student-leave">
      <h1 v-if="!seen">Student Leave</h1>
      <div v-for="leave of listOfStudentsLeave" :key="leave">
        <div class="students-card" v-if="!seen">
          <div class="card" @click="seen = !seen">
            <div class="student-profile">
              <img  :src="'http://127.0.0.1:8000/storage/pictures/' + leave.student.image" alt=""/>
            </div>
            <div class="student-info">
              <h3>{{leave.student.lastname}} {{leave.student.firstname}}</h3>
              <p>{{leave.student.class}}</p>
            </div>
            <h4>{{leave.status}}</h4>
          </div>
        </div>
        <div class="leave-card" v-if="seen">
          <div class="detail-card">
            <div class="cancelIcon">
              <img src="@/assets/cancelIcon-removebg-preview.png" alt="" @click="seen = !seen" >
            </div>
            <div class="student-infor">
              <div class="student-profile">
                <img :src="'http://127.0.0.1:8000/storage/pictures/' + leave.student.image" alt=""/>
              </div>
              <div class="student-info">
                <h3>{{leave.student.lastname}} {{leave.student.firstname}}</h3>
                <p>{{leave.student.class}}</p>
              </div>
            </div>
            <hr>
            <div class="leave-info">
              <div class="leave-date">
                <div>
                  <h4>Start date: </h4>
                  <p>{{leave.start_date}}</p>
                </div>
                <div>
                  <h4>End date: </h4>
                  <p>{{leave.end_date}}</p>
                </div>
                <div>
                  <h4>Duration : </h4>
                  <p>{{leave.duration}} days</p>
                </div>
                <div>
                  <h4>Request date: </h4>
                  <p>{{leave.created_at}}</p>
                </div>
              </div>
              <div class="leave-text">
                <div>
                  <h4>Leave Type : </h4>
                  <p>{{leave.leave_type}}</p>
                </div>
                <div class="textArea">
                  <h4>Reason: </h4>
                  <p>{{leave.reason}}</p>
                </div>
                <div>
                  <h4>Status :</h4>
                  <p>{{leave.status}}</p>
                </div>
                <div class="status">
                  <button @click="updateAproved(leave)" class="btn-aproved" type="button">Aproved</button>
                  <button @click="updateReject(leave)"  class="btn-reject" type="button">Reject</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </section>
</template>


<script>

 import http from "../../axios-http";
export default {
  data() {
    return {
      seen: false,
      listOfStudentsLeave: [],
      listOfStudents:[],
      reference:"",
      status:''
    };
  },

  methods: {
    getlistOfStudentsLeave() {
      http.get("studentleaveRequest").then((res) => {
          this.listOfStudentsLeave = res.data;
        console.log(this.listOfStudentsLeave);
      });
    },
    updateReject(leave){
      http.put("updateLeaveRequest/"+leave.id,{"status":"Reject"}).then((res)=>{
        this.getlistOfStudentsLeave();
        console.log(res.data);
      })
      console.log(leave.status);
    },
    updateAproved(leave){
      http.put("updateLeaveRequest/"+leave.id,{"status":"Aproved"}).then((res)=>{
      this.getlistOfStudentsLeave();
        console.log(res.data);
      })
      console.log(leave.status);
    },

  },
    mounted() {
    this.getlistOfStudentsLeave();
  }

}
</script>

<style scoped>
section{
  display: flex;
  justify-content: center;
}
.student-leave{
  background: rgb(246, 245, 245);
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  width: 60%;
  margin-top: 2rem;
  border-radius: 5px;
}
.student-leave h1{
  text-align: center;
  margin: 10px;
}
  .students-card{
    background: rgb(222, 222, 222);
    margin: 1rem 2.5rem 1.5rem 2.5rem;
    border-radius: 5px;
    cursor: pointer;
  }
  .card,.student-infor{
    display: flex;
  }
  .card .student-info, .student-infor .student-info{
    margin-top: 35px;
  }
  .card h4{
    margin-left: 25rem;
    margin-top: 10px;
  }
  .student-profile{
    padding: 1rem;
  }
  .student-profile img{
    width: 90%;
    height: 12vh;
    border-radius: 50%;
    border: 2px solid orange;
  }
  /* Detail information style */

  .detail-card{
    background: chocolate;
    margin: 30px;
    border-radius: 5px;
  }
.leave-info{
  display: flex;
  margin: 10px;
  justify-content: space-around;
}
.leaveInfo .leave-date,.leave-text{
  width: 50%;
  padding:0.5rem;
}
.leave-date div,.leave-text div{
    display: flex;
    padding: 0.5rem;
}
.leave-date p, .leave-text p{
  margin-left: 4px;
}
.textArea{
  line-height: 1.7rem;
}
.btn-aproved{
  background: #23BBEA;
  margin-left: 10rem;
}
.btn-reject{
  background: #FF9620;
  margin-left: 15px;
}
.btn-aproved,.btn-reject{
  color: white;
  border: none;
  padding: 10px;
  width: 23%;
  border-radius: 10px;
  font-size: 15px;
}
.cancelIcon img{
  width: 5%;
  height: 5%;
  margin-left: 94%;
  margin-bottom: -30px;
}

</style>