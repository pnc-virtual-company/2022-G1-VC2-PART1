<!--                                            All Update                             -->
<template>
  <section >
    <div class="student-leave" v-if="!seen">
        <h1>Student Leave</h1>
      <div v-for="(leave) of listOfStudentsLeave" :key="leave">
        <div class="students-card" v-if="!seen" >
          <div class="card" @click="getAleave(leave.id)">
            <div class="student">
              <div class="student-profile" :style="{'border-left':'6px solid #FF9620'}">
                <img  :src="'http://127.0.0.1:8000/storage/pictures/' + leave.student.image" alt=""/>
              </div>
              <div class="student-info">
                <h4>{{leave.student.lastname}} {{leave.student.firstname}}</h4>
                <p>{{leave.student.class}} {{leave.student.batch}}</p>
              </div>
            </div>
            <div class="stauts">
              <h4 :class="leave.status.toLowerCase()" >{{leave.status}}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
   <div v-if="seen" class="leave">
     <div class="leave-card"  v-for ="leave of listOfALeave" :key="leave">
          <div class="detail-card">
            <div class="cancelIcon">
              <img src="@/assets/cross.png" alt="" @click="seen = !seen" >
            </div>
            <div class="student-infor">
              <div class="student-profile-detail">
                <img :src="'http://127.0.0.1:8000/storage/pictures/' + leave.student.image" alt=""/>
              </div>
              <div class="student-info">
                <h3>{{leave.student.lastname}} {{leave.student.firstname}}</h3>
                <p>{{leave.student.class}} {{leave.student.batch}}</p>
              </div>
            </div>
            <hr>
            <div class="leave-info">
              <div class="leave-date">
                <div>
                  <h5>Start date: </h5>
                  <p>{{leave.start_date}}</p>
                </div>
                <div>
                  <h5>End date: </h5>
                  <p>{{leave.end_date}}</p>
                </div>
                <div>
                  <h5>Duration : </h5>
                  <p>{{leave.duration}} days</p>
                </div>
                <div>
                  <h5>Request date: </h5>
                  <p>{{leave.created_at}}</p>
                </div>
              </div>
              <div class="leave-text">
                <div>
                  <h5>Leave Type : </h5>
                  <p>{{leave.leave_type}}</p>
                </div>
                <div class="textArea">
                  <h5>Reason: </h5>
                  <p>{{leave.reason}}</p>
                </div>
                <div>
                  <h5>Status :</h5>
                  <p :class="leave.status.toLowerCase()" id="status-detail">{{leave.status}}</p>
                </div>
                <div class="status" v-if="leave.status ==='Padding'">
                  <button @click="updateAproved(leave)" class="btn-aproved" type="button">Aproved</button>
                  <button @click="updateReject(leave)"  class="btn-reject" type="button">Reject</button>
                </div>
              </div>
            </div>
          </div>
        </div>
   </div>
    </section>
</template>

<script>

 import axios from "@/axios-http";
export default {
  data() {
    return {
      seen: false,
      listOfStudentsLeave: [],
      listOfALeave:[],
    };
  },

  methods: {
    getlistOfStudentsLeave() {
      axios.get("student_leave_request").then((res) => {
          this.listOfStudentsLeave = res.data;
        console.log(this.listOfStudentsLeave.reverse());
      });
    },
    getAleave(id){
      axios.get("student_leave_request/"+id).then((res) => {
          this.listOfALeave = res.data;
          this.seen = !this.seen;
      });
    },
    updateReject(leave){
      axios.put("student_leave_request/"+leave.id,{"status":"Reject"}).then((res)=>{
        this.getAleave(leave.id);
        this.getlistOfStudentsLeave()
        console.log(res.data);
      })
    },
    updateAproved(leave){
      axios.put("student_leave_request/"+leave.id,{"status":"Aproved"}).then((res)=>{
        this.getAleave(leave.id);
      this.getlistOfStudentsLeave()
        console.log(res.data);
      })
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
  width: 60%;
  margin-top: 2rem;
  border-radius: 5px;
  border: 0.5px solid rgb(195, 195, 195);
}
.leave{
  width: 60%;
}
.student-leave h1{
  padding: 15px;
  font-size: 1.5rem;
  color:white;
   border-radius: 5px;
  background: #23BBEA;
}
  .students-card{
    border: 0.5px solid rgb(195, 195, 195);
    margin: 1rem 2.5rem 1.5rem 2.5rem;
    border-radius: 5px;
    cursor: pointer;
  }
  .card{
    display: flex;
    justify-content: space-between;
    margin-right: 10px;
  }
  .student{
    display: flex;
  }
  .student-infor{
    background: #23BBEA;
    border-radius:5px ; 
    margin-top: -17px;
    display: flex;
  }
  .student-profile-detail img{
    width: 90%;
    height: 15vh;
    border-radius: 50%;
    border: 2px solid orange;
    margin-left: 10px;
    margin-top: 2px;
  }
.student-info{
    margin-top: 25px;
    margin-left: 20px;
  }
  .student-info p{
    font-size: 0.9rem;
  }
.padding{
  color: #FF9620;
  margin-top: 1rem;
}
.aproved{
  color: green;
  margin-top: 1rem;
}
.reject{
  color: red;
  margin-top: 1rem;
}
  .student-profile{
    padding: 0.5rem;
  }
  .student-profile img{
    width: 100%;
    height: 50px;
    border-radius: 50%;
    border: 2px solid orange;
  }
  /* Detail information style */

  .detail-card{
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    margin: 30px;
    border-radius: 5px;
    width: 100%;
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
    margin: 10px;
}
.leave-date p, .leave-text p{
  margin-left: 4px;
}
.leave-date h5, .leave-text h5{
  font-size: 1.1rem;
  line-height: -10px;
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
#status-detail{
  font-weight:800;
  margin-top: -3px;
}

</style>
<!--                                                    End Updated                                 -->