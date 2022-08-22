<template>
  <form @submit.prevent="addStudent">
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
    <button class="form-group btn" type="submit">ADD</button>
  </form>
</template>
<script>
import http from "../../axios-http"
export default {
  data(){
    return{
      firstname:"",
      lastname:"",
      email:"",
      password:"",
      gender:"",
      classroom:"",
      generation:"",
      image: null,
    }
  },
  methods:{
    uploadImage(e){
      this.image = e.target.files[0]
    },
    addStudent(){
       const config = {
            headers: { 'content-type': 'multipart/form-data' }
        }
        let username = this.firstname + " " + this.lastname
        let student = new FormData()
        student.append("username", username)
        student.append("email", this.email)
        student.append("password", this.password)
        student.append("gender", this.gender)
        student.append("class", this.classroom)
        student.append("batch", this.generation)
        student.append("image", this.image)
        http.post('student', student, config).then(res => {
            this.firstname = '';
            this.lastname = '';
            this.email = '';
            this.password = '';
            this.gender='';
            this.classroom = '';
            this.generation = '';
            console.log(res);
        });
        this.$emit('add-Student', false);
      },
    },
  }

</script>

<style scoped>
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
</style>