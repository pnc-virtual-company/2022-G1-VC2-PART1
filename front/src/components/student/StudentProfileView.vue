
<template>
  <div v-if="clickEdit" class="mainDiv">
    <div class="cardStyle">
      <form @submit.prevent="validatePassword" id="signupForm">
        <div class="card_profile">
        <img :src="'http://127.0.0.1:8000/storage/pictures/'+profile.image" alt="" class="img-profile" />
      </div>
        <h2 class="formTitle">Update your password</h2>

        <div class="inputDiv">
          <label class="inputLabel" for="password">New Password</label>
          <input
            type="password"
            v-model="password"
            name="password"
            required
            autocomplete="on"
          />
         
        </div>

        <div class="inputDiv">
          <label class="inputLabel" for="confirmPassword"
            >Confirm Password</label
          >
          <input
            type="password"
            v-model="confirmPassword"
            name="confirmPassword"
            required
            autocomplete="on"
          />
        </div>

        <div class="buttonWrapper">
          <button
            type="submit"
            id="submitButton"
            class="submitButton pure-button pure-button-primary"
          >
            <span>Continue</span>
            <!-- <span id="loader"></span> -->
          </button>
        </div>
      </form>
    </div>
  </div>

  <div v-if="!clickEdit" class="contianer">
    <div class="card">
      <div class="card_profile">
        <img :src="'http://127.0.0.1:8000/storage/pictures/'+profile.image" alt="" class="img-profile" />
      </div>
      <div class="card_body">
        <div class="student-name">{{ profile.username }}</div>
        <ul>
          <li>
            <span class="bold-text">Class : </span>
            <span>{{ profile.class }}</span>
          </li>
          <li>
            <span class="bold-text">Batch : </span>
            <span>{{ profile.batch }}</span>
          </li>
          <li>
            <span class="bold-text">Gender : </span>
            <span>{{ profile.gender }}</span>
          </li>
          <li>
            <span class="bold-text">Email : </span>
            <span>{{ profile.email }}</span>
          </li>
        </ul>
      </div>
      <button @click="clickEdit = true" class="btn-edit">Edit</button>
    </div>
  </div>
</template>
<script>
export default {
  props: ["profile"],
  emits: ["updatePassword"],
  data() {
    return {
      confirmPassword: "",
      password: "",
      clickEdit: false,
    };
  },
  methods: {
    validatePassword() {
      if (
        this.password != "" &&
        this.confirmPassword != "" &&
        this.confirmPassword == this.password
      ) {
        const newStudent = {}
        newStudent.username = this.profile.username;
        newStudent.email = this.profile.email;
        newStudent.password = this.password;
        newStudent.gender = this.profile.gender;
        newStudent.batch = this.profile.batch;
        newStudent.class = this.profile.class;
        newStudent.image = this.profile.image;
      
        this.$emit("updatePassword", newStudent);
        this.clickEdit = false;
      } else {
        this.clickEdit = true;
      }
    },
  },
};
</script>

<style scoped>
.contianer {
  width: 50%;
  margin: 2rem auto;
}
.card {
  background: #144e5a;
  color: white;
  width: 60%;
  margin: auto;
  padding: 5rem 2rem;
  border-radius: 10px;
  box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px,
    rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
}
.card_body {
  text-align: center;
}
ul li {
  list-style: none;
  padding: 10px 0;
  display: flex;
}
.card_profile {
  border-radius: 50%;
  padding: 5px;
  display: flex;
  align-items: center;
  justify-content: center;

}
.img-profile {
  margin: auto;
  box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px,
    rgba(6, 24, 44, 0.65) 0px 4px 6px -1px,
    rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
  width: 8rem;
  height: 8rem;
  border-radius: 100%;
}
.student-name {
  font-weight: bolder;
}
.bold-text {
  text-align: start;
  font-weight: bolder;
  width: 6rem;
}
.btn-edit {
  padding: 10px 20px;
  margin-bottom: -8rem;
  background-color: #065492;
  border-color: #065492;
  color: white;
  border-radius: 5px;
}
.mainDiv {
  display: flex;
  min-height: 100%;
  align-items: center;
  justify-content: center;
  background-color: #f9f9f9;
  font-family: "Open Sans", sans-serif;
}
.cardStyle {
  width: 500px;
  border-color: white;
  background: #fff;
  padding: 36px 0;
  border-radius: 4px;
  margin: 30px 0;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
}
#signupLogo {
  max-height: 100px;
  margin: auto;
  display: flex;
  flex-direction: column;
}
.formTitle {
  font-weight: 600;
  margin-top: 20px;
  color: #2f2d3b;
  text-align: center;
}
.inputLabel {
  font-size: 12px;
  color: #555;
  margin-bottom: 6px;
  margin-top: 24px;
}
.inputDiv {
  width: 70%;
  display: flex;
  flex-direction: column;
  margin: auto;
}
input {
  height: 40px;
  font-size: 16px;
  border-radius: 4px;
  border: none;
  border: solid 1px #ccc;
  padding: 0 11px;
}
input:disabled {
  cursor: not-allowed;
  border: solid 1px #eee;
}
.buttonWrapper {
  margin-top: 40px;
}
.submitButton {
  width: 70%;
  height: 40px;
  margin: auto;
  display: block;
  color: #fff;
  background-color: #065492;
  border-color: #065492;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.12);
  box-shadow: 0 2px 0 rgba(0, 0, 0, 0.035);
  border-radius: 4px;
  font-size: 14px;
  cursor: pointer;
}
.submitButton:disabled,
button[disabled] {
  border: 1px solid #cccccc;
  background-color: #cccccc;
  color: #666666;
}

#loader {
  position: absolute;
  z-index: 1;
  margin: -2px 0 0 10px;
  border: 4px solid #f3f3f3;
  border-radius: 50%;
  border-top: 4px solid #666666;
  width: 14px;
  height: 14px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>