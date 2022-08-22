<template>
  <div v-if="isUpdated" class="contianer_update">
    <form @submit.prevent="toUpdate">
      <div class="username">
          <div class="inputname">
              <label for="">First Name:</label>
              <input
                class="firstname"
                type="text"
                v-model="firstname"
              />
          </div>
          <div class="inputname">
              <label for="" class="lastName">Last Name:</label>
              <input
                class="lastname"
                type="text"
                v-model="lastname"
              />
          </div>
      </div>
      <div class="email">
          <label for="">Email:</label>
          <input
          class="form-group"
          type="text"
          v-model="email"
          />
      </div>
      <div class="password">
          <label for="">Password:</label>
          <input
          class="form-group"
          type="text"
          v-model="password"
          />
      </div>

      <div class="gender">
        <label for="">Gender:</label>
          <input
          class="form-group"
          type="text"
          v-model="gender"
          />
      </div>
      <div class="username">
          <div class="inputname">
              <label for="">Class:</label>
              <input
                class="classroom"
                type="text"
                v-model="classroom"
              />
            
          </div>
          <div class="inputname">
              <label for="" class="lastName">Generation:</label>
              <input
                class="generation"
                type="text"
                v-model="generation"
              />
          </div>
          
      </div>
      <div id="choose-img">
        <input type="file" id="up" @change = "uploadImage" >
      </div>
      <button class="form-group btn" type="submit">Update</button>
    </form>
  </div>
  <div class="container">
    <div class="btnadd">
        <button class="btn-add" @click="addStudent()">Add+</button>
    </div>
    <div class="actionStudents">
        <div class="totalStudents">
          <div class="total">Total:</div>
          <div class="numberOfStudents">{{listOfStudents.length}}</div>
        </div>
        <div class="totalStudentsAbsent">
          <div class="total">Absent</div>
            <div class="numberOfStudentsAbsent">2</div>
        </div>
    </div>
    <div class="card">
        <h2>List all students in PNC</h2>
      <div class="card-list" v-for:="(student, index) of listOfStudents">
        <div class="user">
          <div class="img">
            <img :src="'http://127.0.0.1:8000/storage/pictures/'+student.image" alt="" />
          </div>
          <div class="info">
            <span><strong>{{student.username}}</strong></span>
          </div>
        </div>
        <div class="icon">
          <button @click="UpdateStudent(student)" class="btnedit"><img src="../../assets/edit.png" alt="" /></button>
          <button @click="removeStudent(index, student.id)" class="btnDelete"><img src="../../assets/delete.png" alt=""/></button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import http from "../../axios-http"

export default {
  emits:['addStudents', "updateStudent"],
  
    data(){
    return{
      listOfStudents:[],
      firstname:"",
      lastname:"",
      email:"",
      password:"",
      gender:"",
      classroom:"",
      generation:"",
      image: null,
      update_id:null,
      isUpdated:false
    }
  },

  methods:{
    studentFromAPI(){
      http.get('student')
      .then((res)=>{
        this.listOfStudents=res.data, console.log(this.listOfStudents)
        })
    },
    
    addStudent(){
      this.$emit('addStudent', true)
    },
    removeStudent(index, id){
      http.delete("student/"+id).then((res)=>{console.log(res)})
      this.listOfStudents.splice(index, 1)
    },
    UpdateStudent(student){
      this.isUpdated=true
      this.update_id=student.id
      this.firstname=student.username
      this.lastname=student.username
      this.email=student.email
      this.password=student.password
      this.gender=student.gender
      this.classroom=student.class
      this.generation=student.batch
    },
    uploadImage(e){
      console.log("This file image", e.target.files[0]);
      this.image = e.target.files[0]
    },
    toUpdate(){
      let newInfor={
        username:this.firstname + " "+ this.lastname,
        email:this.email,
        password:this.password,
        gender:this.gender,
        class:this.classroom,
        batch:this.generation,
        image:this.image
        
      }
      this.$emit("updateStudent", {update_id: this.update_id, infor:newInfor})
      this.isUpdated=false
    }
    
  },
  mounted(){
    this.studentFromAPI()
  },

};
</script>

<style scoped>
  .contianer_update{
    position:absolute;
    width: 100%;
    padding: 4rem 0;
    background-color:rgb(184, 182, 182);
  }
  form {
  width: 40%;
  padding: 20px;
  margin: auto;
  margin-top: 20px;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26);
  background: #144e5a;
}
.form-group {
  width: 100%;
  padding: 10px;
  margin-bottom: 16px;
  border: solid 1px rgb(124, 117, 117);
  border-radius: 5px;
  box-sizing: border-box;
  outline: none;
  margin-top: 5px;
}
.btn {
  background: orange;
  border: none;
  color: #fff;

}

.firstname, .lastname, .classroom, .generation {
    width: 100%;
    padding: 10px;
  margin-bottom: 16px;
  border: solid 1px rgb(124, 117, 117);
  border-radius: 5px;
  box-sizing: border-box;
  outline: none;

}


.username{
    display: flex;
}

.inputname{
    display:block;
}

.lastname, .generation{
    margin-left: 5px;
}

label{
  font-weight: bold;
  color:white;
}
.btnadd{
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

.btnedit, .btnDelete {
  border: none;
  justify-content:space-around;
  background-color:white;
  margin: 0 10px;

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
    justify-content:space-between;
    border-radius: 5px;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
}

.totalStudentsAbsent{
  margin-left: 10px;
}

.total{
   background-color:rgb(53, 159, 245);
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
