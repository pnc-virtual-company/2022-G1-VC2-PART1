<template>
  <div class="container">
    <div class="overlay-container">
      <div class="overlay">
        <img src="@/assets/Login.png" alt="" />
      </div>
    </div>
    <div class="form-contianer">
      <div class="login-form">
        <h1>Login</h1>
        <h3>Email:</h3>
        <div class="form-group">
          <input type="text" placeholder="email" v-model="email" />
        </div>
        <div class="error" v-if="emailError">
          <p v-text="emailError"></p>
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
        <div class="serverMessage" v-if="unauthorizedError">
          <p v-text="unauthorizedError"></p>
        </div>
        <div class="error" v-if="passwordError">
          <p v-text="passwordError"></p>
        </div>
        <br />
        <button :disabled='!isValidated' :class="isValidated ? 'buttonActive' : 'buttonInactive'"  value="Login" class="login-button" @click.prevent="handleClick">
          Login
        </button>
        <br />
      </div>
    </div>
  </div>
</template>
<script>
// import axios from "@/axios-http";
export default {
  emits: ["sign-in"],
  props: ["unauthorizedError"],
  data() {
    return {
      isPasswordShow: false,
      email: "",
      password: "",
      emailError: "",
      passwordError: "",
    };
  }, watch: {
    email: function(value) {
      const emailRegex = RegExp(
        /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
      );
      if(emailRegex.test(value)) {
        this.emailError = '';
      } else {
        this.emailError = 'invalid email';
      }
    },
    password: function(value) {
      if(value.length >= 8) {
        this.passwordError = '';
      } else {
        this.passwordError = "password must be at least 8 characters";
      }
    },
  },
  computed: {
    isValidated() {
      return this.emailError === '' && this.passwordError === '' && this.email !== '' && this.password !== '';
    }
    
  },

  methods: {
    showHidePassword() {
      this.isPasswordShow = !this.isPasswordShow;
    },

    handleClick() {
      if(this.isValidated) {
        let userData = {
        email: this.email,
        password: this.password,
      };
      this.$emit("sign-in", userData);
      }

    },
  },
  mounted() {
    if (localStorage.getItem("accessToken") === null) {
      this.$router.push("/");
    } else {
      this.$router.push("/welcome");
    }
  },
};
</script>
<style scoped>
.container {
  display: flex;
  margin: 0 auto;
}

.overlay {
  margin: 10px 10px;
}

.form-contianer {
  width: 300%;
  margin: 10px;
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
  background: #f2f2f2;
}

input {
  width: 90%;
  padding: 10px;
  border: none;
  outline: none;
  background: #f2f2f2;
}

h3 {
  padding-left: 15px;
}

.login-form h3 {
  text-align: left;
  color: #fff;
  margin: 5px 40px;
}

.login-form h1 {
  font-size: 30px;
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
  box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px,
    rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
}

.login-button {
  height: 40px;
  width: 100px;
  border: 1px solid #f2f2f2;
  border: none;
  border-radius: 10px;
  color: white;
  text-transform: uppercase;
  font-family: "Ubuntu", sans-serif;
  cursor: pointer;
}
.buttonActive{
  background-color: orange;
}
.buttonInactive{
  background-color: #f2f2f2;
  color:orange;
}
.error,.serverMessage {
  color: rgb(255, 97, 97);
  margin: 5px 0 0 3.5rem;
  text-align: left;
}
</style>
