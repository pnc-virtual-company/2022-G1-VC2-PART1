<template>
  <div class="container">
    <div class="btnadd">
        <button class="btn-add">Add+</button>
    </div>
    <div class="actionStudents">
        <div class="totalStudents">
          <div class="total">
            <span><strong>Total</strong></span>
          </div>
            <div class="numberOfStudents">146</div>
        </div>
        <div class="totalStudentsAbsent">
          <div class="absent">

            <span><strong>Absent</strong></span>
          </div>
            <div class="numberOfStudentsAbsent">2</div>
        </div>
    </div>
    <div class="card">
        <h2>List all students in PNC</h2>
      <div class="card-list" v-for="student of listOfStudents" :key="student">
        <div class="user">
          <div class="img">
            <img src="../../assets/lolo.jpg" alt="" />
          </div>
          <div class="info">
            <span><strong>{{student.username}}</strong></span>
          </div>
        </div>
        <div class="icon">
          <img src="../../assets/edit.png" alt="" />
          <img src="../../assets/delete.png" alt="" />
        </div>
      </div>
     
    </div>
  </div>
  <list-students></list-students>
</template>

<script>
import http from "../../axios-http"
import ListStudents from "./AddStudent.vue"
export default {
  components: {
    "list-students":ListStudents,
  },
    data(){
    return{
      listOfStudents:[]
    }
  },

  methods:{
    getStudentFromApi(){
      http.get('student')
      .then((res)=>{
        this.listOfStudents=res.data, console.log(this.listOfStudents)
        })
    }

  },

  mounted(){
    this.getStudentFromApi()
  }

};
</script>

<style  scoped>

.btnadd {
    width: 50%;
    display:flex;
    justify-content:flex-end;
    margin: 10px auto;
    
}
.btn-add{
    width: 25%;
    padding: 10px;
    font-size: 15px;
    background-color:rgb(53, 159, 245);
    border: none;
    border-radius: 5px;
    
}

.actionStudents{
    width: 50%;
    display: flex;
    margin: auto;
}

.totalStudents, .totalStudentsAbsent{
    width: 30%;
    height: 10vh;
    display:flex;
    border: 1px solid black;
    border:none;
    border-radius: 5px;
    background-color:blue;
}

.totalStudentsAbsent{
  margin-left: 10px;
}

.card {
    width: 50%;
  border: 1px solid black;
  border-radius: 10px;
  margin:10px auto;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
}

h2{
    margin-top: 10px;
    font-size:200%;
    text-align: center;
    color: rgb(91, 183, 245);
}
.card-list {
    border-bottom: 1px solid black;
  margin-top: 10px;
  display: flex;
  justify-content: space-between;
  padding: 10px;
}

.user {
  display: flex;
}

.info {
  padding: 0 10px;
  margin-top: 15px;
}

img {
  /* border-radius: 360px; */
  height: 50px;
  border-radius: 100%;
  width: 50px;
}

.icon img {
    margin-top: 10px;
  width: 20px;
  height: 4vh;
}
</style>
