<template>
  <div class="container">
    <div class="overlay-container">
      <div class="overlay">
        <img src="@/assets/Login.png" alt=""/>
      </div>
    </div>
    <div class="form-contianer">
        <div class="login-form">
          <h1>Login</h1>
          <h3>Email:</h3>
          <div class="form-group">
            <input type="text" placeholder="email" v-model="email" />
          </div>
          <h3>Password:</h3>
          <div class="form-group">
            <input
              :type="isPasswordShow ? 'text' : 'password'"
              placeholder="Password"
              v-model="password"
            />
            <i
              @click="showHidePassword"
              :class="isPasswordShow ? 'fa fa-eye' : 'fa fa-eye-slash'"
              style="font-size: 20px"
            ></i>
          </div>
          <br />
          <button  value="Login" class="login-button" @click="handleClick">Login</button>
          <br />
        </div>
      </div>
  </div>
</template>
<script>
import axios from "@/axios-http"
export default {
  emits:["sigin"],
  data() {
    return {
      isPasswordShow: false,
      email:"",
      password:"",
    };
  },

  methods: {
    showHidePassword() {
      this.isPasswordShow = !this.isPasswordShow;
    },

    handleClick(event){
      event.preventDefault()
      axios.post("user/sigin", {email:this.email, password:this.password})
      .then(response =>{
        this.userSigin(response.data.role)
      })
    },
    userSigin(admin){
      if(admin){
        axios.post("teacher/sigin", {email:this.email, password:this.password})
        .then(response =>{
          localStorage.setItem("accessToken", response.data.token)
          localStorage.setItem("user_role", "admin")
        })
      }else{
        axios.post("student/sigin", {email:this.email, password:this.password})
        .then(response =>{
          localStorage.setItem("accessToken", response.data.token)
          localStorage.setItem("user_role", "student")
        })
      }
      // setTimeout(() => {window.location.reload()}, 1000)
      this.$router.push("/welcome")
    }
  },
};
</script>
<style scoped>
.container {
  display: flex;
  margin: 0 auto;
}

.overlay{
    margin: 10px 10px;
}

.form-contianer {
  width: 300%;
  margin: 10px ;
}

.form-group {
  width: 82%;
  border: 1px solid black;
  border-radius: 5px;
  border: none;
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: auto;
  padding: 5px;
  box-sizing: border-box;
  background:#f2f2f2;
}

input {
  width: 90%;
  padding: 10px;
  border: none;
  outline: none;
  background:#f2f2f2;
}

h3 {
padding-left: 15px;
}

.login-form h3 {
  text-align: left;
  color: #fff;
  margin:5px 40px;
}

.login-form h1{
    font-size:30px;
    color: #fff;
}
.login-form {
  box-sizing: border-box;
  padding-top: 15px;
  padding-bottom: 10%;
  margin: 10% auto;
  text-align: center;
  background-color: #4facff;
  border-radius: 10px;
  max-width: 600px;
  box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
}

.login-button{
  height: 40px;
  width: 100px;
  background-color: orange;
  border: 1px solid #f2f2f2;
  border:none ;
  border-radius: 10px;
  color: white;
  text-transform: uppercase;
  font-family: "Ubuntu", sans-serif;
  cursor: pointer;
}

</style>
